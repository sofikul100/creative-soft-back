<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

class ManageUserController extends Controller
{
    public function all_users (){
        $users = User::all();
        return view('backend.manage_users.all_users',compact('users'));
    }



    public function add_user_form (){
        $roles = DB::table('roles')->get();
        return view('backend.manage_users.add_user',compact('roles'));
    }

    public function add_user (Request $request){
        $request->validate([
           'name'=>'required',
           'email'=>'email|required|unique:users',
           'password'=>'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->role){
            $user->assignRole($request->role);
        }

        return redirect()->route('all.users')->with('message','User Added Successfully');
    }



    public function editUser ($id){
        $user = User::findOrFail($id);
        $roles = DB::table('roles')->get();
        return view('backend.manage_users.edit_user',compact('user','roles'));
    }



    public function update_user (Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email'
        ]);
        
        $user =User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        $user->roles()->detach();
        if($request->role){
            $user->assignRole($request->role);
        }

        return redirect()->route('all.users')->with('message','User updated successfully');
        
    }




    public function delete_user (Request $request){
        $user =User::findOrFail($request->id);

        if(!is_null($user)){
            $user->delete();
        }

        return response()->json(['success'=>true,'message'=>'User Deleted Successfully']);
    }







}
