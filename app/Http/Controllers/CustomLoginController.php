<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Auth;

class CustomLoginController extends Controller
{
    public function loginUser(Request $request)
    {
		$validator = Validator::make($request->all(),
			[
				'email' => 'required|email',
				'password' => 'required'
			]
		);

		if($validator->fails()) {
			return response()->json([
				'notify' => 'inline',
				'status' => 'danger',
				'message' => $validator->errors()->all()
			]);
		}

    	$email = $request->email;
    	$password = $request->password;
		$rememberToken = 0;//$request->remember;
		if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
			$msg = array(
				'notify' => 'inline',
				'status'  => 'success',
				'message' => 'Login Successful',
				'action' => 'reload'
			);
			return response()->json($msg);
		} else {
			return back()->with('success','Email Address or Password Incorrect!');
		}
    }
}
