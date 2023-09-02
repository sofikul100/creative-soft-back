<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Gd\Commands\InsertCommand;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function PHPUnit\Framework\isEmpty;

class RoleController extends Controller
{
    public function all_permission (){
        $permissions = Permission::all();
        return view('backend.role-permission.allpermission',compact('permissions'));
    }



    public function  add_permission (Request $request){
         $request->validate([
            'name'=>'required',
            'group_name'=>'required'
         ]);

         $permission = Permission::create([
            'name'=>$request->name,
            'group_name'=>$request->group_name
         ]);

         if($permission){
            return redirect()->back()->with('message','Permission Added Successfully');
         }


    }


    public function edit_permission ($id) {
         $permission = Permission::find($id);
         $permissions = Permission::select('group_name')->groupBy('group_name')->get();
         return view('backend.role-permission.editpermission',compact('permission','permissions'));
    }



    public function update_permission (Request $request,$id) {
          $request->validate([
             'name'=>'required',
             'group_name'=>'required'
          ]);

          $permission = Permission::find($id);
          $permission->name = $request->name;
          $permission->group_name = $request->group_name;

          $permission->save();

          if($permission->save()){
            return redirect()->route('all.permission')->with('message','Permission updated successfully');
          }
    }




    public function delete_permission(Request $request){

        $permission = Permission::find($request->id);
        $permission->delete();

        return response()->json(['message'=>'Permission deleted  Successfully','success'=>true]);
    }



    //============all role method start here=========//


    public function all_role (){
      $roles = Role::all();
      return view('backend.role-permission.allrole',compact('roles'));
    }



    public function add_role (Request $request){
       $request->validate([
          'name'=>'required'
       ]);

       $role = Role::create([
         'name'=>$request->name
       ]);
       
       if($role){
          return redirect()->back()->with('message','Role added successfully');
       }
    }



    public function edit_role ($id){
       $role = Role::find($id);
       return view('backend.role-permission.editrole',compact('role'));
    }


    public function update_role (Request $request,$id){
       $request->validate([
          'name'=>'required'
       ]);
       $role = Role::find($id);

       $role->name = $request->name;
       $role->save();

       if($role->save()){
         return redirect()->route('all.role')->with('message','Role Updated Successfully');
       }
    }






    public function delete_role (Request $request){
      $role = Role::find($request->id);
      $role->delete();

      return response()->json(['message'=>'Role deleted  Successfully','success'=>true]);
    }




    //========== role permission method here===========//

    public function role_permission (){
       $roles = Role::all();
       $permission_groups =User::getPermissionGroups();
       return view('backend.role-permission.add_role_permission',compact('roles','permission_groups'));
    }



    public function add_role_permission (Request $request){
       $request->validate([
          'role_id'=>'required'
       ]);
       $data = array();
       $permissions = $request->permissions;

       foreach($permissions as $key => $permission){
           $data['role_id'] = $request->role_id;
           $data['permission_id'] = $permission;

           DB::table('role_has_permissions')->insert($data);
       }

       return redirect()->route('all.role.permission')->with('message','Role Permission successfully Added');
    }



    public function  all_role_permissions (){
        $roles = Role::all();
        return view('backend.role-permission.all_role_permission',compact('roles'));
    }


    public function edit_role_permission ($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups =User::getPermissionGroups();
        return view('backend.role-permission.edit_role_permission',compact('role','permissions','permission_groups'));
    }




    public function update_role_permission (Request $request,$id){
        $role = Role::findOrFail($id);
        $permissions = $request->permissions;

        if(!empty($permissions)){
          $role->syncPermissions($permissions);
        }

        return redirect()->route('all.role.permission')->with('message','Role Permission successfully Updated');
    }


    public function delete_role_permission (Request $request){
         $role = Role::findOrFail($request->id);
         if(!is_null($role)){
            $role->delete();
         }

         return response()->json(['message'=>'Role and permission successfully deleted','success'=>true]);
    }



    //=========ajax==========
    public function check_role_has_permission (Request $request){
      $has_permission = DB::table('role_has_permissions')->where('role_id',$request->role_id)->get();
      // return response()->json([$has_permission]);
      if($has_permission->isEmpty()){
         return response()->json(['success'=>false,'message'=>'nothing']);
      }else{
         return response()->json(['success'=>true,'message'=>'has_permission']);
      }
      
    }

}
