<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {   
        $current_user_data = User::find(Auth::user()->id);
        return view('profile.edit',compact('current_user_data'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {   $request->validate([
           'name'=>'required|max:30',
           'email'=>'required|email',
           'avatar'=>'image|mimes:jpg,png,jpeg,svg|max:2048'
        ]);


        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone; 

        

        if($request->file('avatar')){
        //    if(file_exists(public_path('/backend/profile_pictures/'.$user->avatar))){
        //       unlink(public_path('/backend/profile_pictures/'.$user->avatar));
        //    }    
          //----------- image upload code ------------//
          $avatar= $request->file('avatar');
          $avatarImage = Image::make($avatar);
          $upload_path = public_path().'/backend/profile_pictures/';
          $avatarImage->resize(120,120);
          $avatar_name = time().'.'.$avatar->getClientOriginalName();
          $avatarImage->save($upload_path.$avatar_name);
          $user->avatar = $avatar_name;
        }

        $user->save();
        return redirect()->back()->with('message',"Your Profile Updated Successfully"); 

           
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }





    public function change_password_form (Request $request){
        $current_user_data = User::find(Auth::user()->id);
        return view('backend.dashboard.change_password',compact('current_user_data'));
    }




    public function check_current_password (Request $request){
        if(Hash::check($request->current_password,Auth::user()->password)){
            return response()->json(['message'=>'Current Password Is Currect','success'=>true]);
        }else{
            return response()->json(['message'=>'Current Password Is InCurrect','success'=>false]);
        }
    }


    public function change_password (Request $request){
        $request->validate([
            'new_password'=>'required',
            'password_confirmation'=>'required|same:new_password'
        ]);

        if(Hash::check($request->current_password,Auth::user()->password)){
             User::where('id',Auth::user()->id)->update(['password'=>bcrypt($request->new_password)]);
             Auth::guard('web')->logout();
             return redirect()->route('login')->with('message','Successfully change password, Please login');
        }else{
            return redirect()->back()->with('message','Current Password does not Match');
        }
    }









}
