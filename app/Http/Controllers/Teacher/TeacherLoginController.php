<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Auth;

class TeacherLoginController extends Controller
{
	public function index(Request $request)
    {
        $row = array();
        if(!empty(request()->cookie('teacher_account'))) {
            $teacher_account = base64_decode(request()->cookie('teacher_account'));
            $teacher_account = explode('|', $teacher_account);
            $row['email'] = $teacher_account[0];
            $row['password'] = $teacher_account[1];
        }
		$row['login_url'] = route('teacher_login');
		return view('auth.login', compact('row'));
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
			return response()->json([
				'notify' => 'inline',
				'status' => 'danger',
				'message' => $validator->errors()->all()
			]);
		}

    	if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 'teacher'])) {
			$msg = array(
				'notify' => 'inline',
				'status'  => 'success',
				'message' => 'Login Successful',
				'action' => 'reload'
			);

			if($request->remember) {
                $teacher_account = base64_encode($request->email.'|'.$request->password);
                return redirect(route('teacher_dashboard'))
                    ->withCookie(cookie('teacher_account', $teacher_account, time() + (86400 * 30))); // 86400 = 1 day;
            } else {
                \Cookie::queue(\Cookie::forget('teacher_account'));
            }

			return redirect(route('teacher_dashboard'));
		} else {
			return back()->with('success','Email Address or Password Incorrect!');
		}
    }
}
