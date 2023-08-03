<?php

namespace App\Http\Controllers\Backend\Admin;

use Auth;
use Validator;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;


class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showChangePasswordForm()
    {
        return view('admin.edit_profile');
    }
    public function checkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = Admin::where(['email'=>Auth::user()->email])->first();
        if (Hash::check($current_password,$check_password->password)) {
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }
    public function updatePassword(Request $request){
        // Validate the form data
        $this->validate($request, [
            'new_password' => 'min:6',
            'repeat_password' => 'required_with:new_password|same:new_password|min:6'
        ]);
        // update pass
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $check_password = Admin::where(['email'=>Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if (Hash::check($current_password,$check_password->password)) {
                $password = bcrypt($data['new_password']);
                Admin::where('id','1')->update(['password'=>$password]);
                return redirect('/admin/change-password')->with('flash_message_success','Password updated successfully');
            }else{
                return redirect('/admin/change-password')->with('flash_message_error','Incorrect current password');
            }
        }
        
    }
}
