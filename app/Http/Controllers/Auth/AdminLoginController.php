<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Auth;
use Validator;
use App\Admin;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin', ['except'=>['logout']]);
	}
    public function showLoginForm(){
    	return view('auth.admin-login');
    }
    public function checkEmail(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $check_email = Admin::Where('email',$email)->count();
        // echo $check_email; die;
        if ($check_email>0) {
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }
    public function login(Request $request){
    	// Validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);
    	// Attempt to log the user in
    	if (Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password], $request->remember)) {
    		// if successful, then redirect to their intended location
            // Session::put('adminSession',$data['email']);
            return redirect()->intended(route('admin.dashboard'));
    	}
    	
    	// if successful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login')->with('flash_message_success','Logged out successfully');
    }
}
