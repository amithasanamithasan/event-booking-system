<?php

namespace App\Http\Controllers\Backend\Admin;

use Auth;
use Validator;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showProfile()
    {
    	return view('admin.profile');
    }
    public function updateProfile(Request $request)
    {
    	if ($request->isMethod('post')) {
	        $this->validate($request,[
	            'name' => 'required | min:4',
	            'email' => 'required',
	            'job_title' => 'required',
	        ]);

	        $id = $request->id;
	        $admin = Admin::find($id);
	        $admin->name = $request->name;
	        $admin->email = $request->email;
	        $admin->job_title = $request->job_title;
	        if ($request->hasFile('image')) {
	            if (!empty($admin->image)) {
	                unlink('images/users/'.$admin->image);
	            }
	            $dir = 'images/users/';
	            $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
	            $fileName = str_random() . '.' . $extension; // rename image
	            $request->file('image')->move($dir, $fileName);
	            $admin->image = $fileName;
	        }

	        $admin->save();
	        return redirect(route('admin.edit.profile'))->with('edit_profile_flash_success','Successfully updated');
    	}else{
    		return redirect(route('admin.edit.profile'))->with('edit_profile_flash_error','Something wrong !');
    	}
    }
}
