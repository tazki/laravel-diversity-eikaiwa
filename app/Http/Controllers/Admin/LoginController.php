<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\AdminGuard;
use App\Notifications\AdminResetPasswordNotification;

class LoginController extends Controller
{
	public function index(Request $request)
    {
        $row = array();
        if(!empty(request()->cookie('admin_account'))) {
            $admin_account = base64_decode(request()->cookie('admin_account'));
            $admin_account = explode('|', $admin_account);
            $row['email'] = $admin_account[0];
            $row['password'] = $admin_account[1];
        }
		return view('admin.login', compact('row'));
	}

    public function loginAdmin(Request $request)
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
        
		if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'user_type' => 'admin'])) {
			$msg = array(
				'notify' => 'inline',
				'status'  => 'success',
				'message' => 'Login Successful',
				'action' => 'reload'
            );

            if($request->remember) {
                $admin_account = base64_encode($request->email.'|'.$request->password);
                return redirect(route('admin_dashboard'))
                    ->withCookie(cookie('admin_account', $admin_account, time() + (86400 * 30))); // 86400 = 1 day;
            } else {
                \Cookie::queue(\Cookie::forget('admin_account'));
            }

            return redirect(route('admin_dashboard'));
		} else {
			return back()->withInput($request->only('email', 'remember'))->with('error','Email Address or Password Incorrect!');
		}
	}
	
	public function forgotPassword()
	{
		return view('admin.passwords.email');
	}

    public function validatePasswordRequest(Request $request)
    {
        //You can add validation login here
		$user = DB::table('users')->where([['email', '=', $request->email], ['user_type', '=', 'admin']])->first();

        //Check if the user exists
        if (!isset($user->id)) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }

        return view('admin.passwords.email');
    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = AdminGuard::where([['email', '=', $email], ['user_type', '=', 'admin']])->select('first_name', 'email')->first();

        try {
            $user->notify(new AdminResetPasswordNotification($token));
            //Here send the link with CURL with an external email API 
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resetPasswordGet(Request $request)
    {
        $token = $request->token;
        return view('admin.passwords.reset', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'token' => 'required' ]);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('admin.passwords.email');

        $user = AdminGuard::where([['email', '=', $tokenData->email], ['user_type', '=', 'admin']])->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $user->update(); //or $user->save();

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
			//login the user immediately they change password successfully
            if(Auth::guard('admin')->attempt(['email' => $user->email, 'password' => $password, 'user_type' => 'admin'])) {
                return redirect('admin/users');
            }
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendSuccessEmail($email) {
        return $email;
    }
}
