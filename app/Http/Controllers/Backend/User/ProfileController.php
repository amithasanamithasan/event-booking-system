<?php

namespace App\Http\Controllers\Backend\User;

use Auth;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showProfile()
    {
    	return view('user.profile');
    }
    public function showEditProfileForm()
    {
    	return view('user.edit_profile');
    }
    public function updateProfile(Request $request)
    {
    	if ($request->isMethod('post')) {
	        $this->validate($request,[
	            'name' => 'required | min:4',
	            'phone' => 'required ',
	        ]);

	        $id = $request->id;
	        $user = User::find($id);
	        $user->name = $request->name;
	        $user->phone = $request->phone;
	        if ($request->hasFile('image')) {
	            if (!empty($user->image)) {
	                unlink('images/users/'.$user->image);
	            }
	            $dir = 'images/users/';
	            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
	            $fileName = str_random() . '.' . $extension; // rename image
	            $request->file('image')->move($dir, $fileName);
	            $user->image = $fileName;
	        }

	        $user->save();
	        return redirect(route('user.edit.profile'))->with('edit_profile_flash_success','Successfully updated');
    	}else{
    		return redirect(route('user.edit.profile'))->with('edit_profile_flash_error','Something wrong !');
    	}
    }
}
