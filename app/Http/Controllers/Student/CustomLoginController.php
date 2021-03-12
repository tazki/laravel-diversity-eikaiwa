<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Auth;

class CustomLoginController extends Controller
{
	public function index(Request $request)
    {
        $row = array();
        if(!empty(request()->cookie('student_account'))) {
            $student_account = base64_decode(request()->cookie('student_account'));
            $student_account = explode('|', $student_account);
            $row['email'] = $student_account[0];
            $row['password'] = $student_account[1];
        }
		$row['login_url'] = route('page_login');
		return view('auth.login', compact('row'));
	}

	public function recaptcha(Request $request)
	{
		$params = array(
			'secret' => '6Le0aXwaAAAAANuh7J2adyFLE5HLZniUnckvOk32',
			'response' => $request->token
		);

		$response = Curl::to('https://www.google.com/recaptcha/api/siteverify')
		->withData($params)
		->post();
		$responseObject = json_decode($response);
		return $response;
	}

    public function loginUser(Request $request)
    {
		$validator = Validator::make($request->all(),
			[
				'email' => 'required|email',
				'password' => 'required'
			]
		);

		if($validator->fails()) {
			return back()->withInput($request->only('email', 'remember'))->withErrors($validator);
		}

    	$email = $request->email;
    	$password = $request->password;
		$rememberToken = $request->remember;
		if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password, 'user_type' => 'student'])) {
			$msg = array(
				'notify' => 'inline',
				'status'  => 'success',
				'message' => 'Login Successful',
				'action' => 'reload'
			);

			if($request->remember) {
                $student_account = base64_encode($request->email.'|'.$request->password);
                return redirect(route('student_dashboard'))
                    ->withCookie(cookie('student_account', $student_account, time() + (86400 * 30))); // 86400 = 1 day;
            } else {
                \Cookie::queue(\Cookie::forget('student_account'));
            }

			return redirect(route('student_dashboard'));
		} else {
			return back()->with('success','Email Address or Password Incorrect!');
		}
    }
}
