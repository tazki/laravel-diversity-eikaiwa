<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $row = array();
        if(!empty(request()->cookie('matome_account'))) {
            $matome_account = base64_decode(request()->cookie('matome_account'));
            $matome_account = explode('|', $matome_account);
            $row['email'] = $matome_account[0];
            $row['password'] = $matome_account[1];
            $row['role'] = $matome_account[2];
        }
        $row['login_url'] = route('page_login');
		return view('auth.login', compact('row'));
    }

    public function login(Request $request)
    {
        if($request->role == 'client') {
            $validator = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validator->fails()) {
                return back()->withInput($request->only('email', 'remember'))->withErrors($validator);
            }

            if (\Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
                $msg = array(
                    'notify' => 'inline',
                    'status'  => 'success',
                    'message' => 'Login Successful',
                    'action' => 'reload'
                );
                
                if(isset($request->redirect_url) && !empty($request->redirect_url)) {
                    return redirect($request->redirect_url);
                }
    
                if($request->remember) {
                    $matome_account = base64_encode($request->email.'|'.$request->password.'|'.$request->role);
                    return redirect()->intended('client/folder')
                        ->withCookie(cookie('matome_account', $matome_account, time() + (86400 * 30))); // 86400 = 1 day;
                } else {
                    \Cookie::queue(\Cookie::forget('matome_account'));            
                }
    
                return redirect()->intended('client/folder');
    
                return redirect('client/folder');
            } else {
                return back()->withInput($request->only('email', 'remember', 'role'))->with('error','Email Address or Password Incorrect!');
            }
        } else {
            $this->validateLogin($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                if($request->remember) {
                    $matome_account = base64_encode($request->email.'|'.$request->password.'|'.$request->role);
                    \Cookie::queue('matome_account', $matome_account, time() + (86400 * 30));
                } else {
                    \Cookie::queue(\Cookie::forget('matome_account'));
                }

                return $this->sendLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function loginShare(Request $request)
    {
        $validator = Validator::make($request->all(),
			[
				'email' => 'required|email'
			]
		);

		if($validator->fails()) {
			return back()->withInput($request->only('email'))->withErrors($validator);
		}

        $id = base64UrlDecode($request->share_id);
        if($request->share_type == 'task') {
            $shareUrl = 'share/t/';
            $row = DB::table('client_tasks')
                ->select('*',
                    DB::raw('DATE_FORMAT(mt_client_tasks.due_date, "%M %d, %Y") as due_date')
                )
                ->where([
                    ['id', '=', $id]
                ])
                ->first();
        } else {
            $shareUrl = 'share/m/';
            $row = DB::table('client_organization_folders')
                ->select('*')
                ->where([
                    ['id', '=', $id]
                ])
                ->first();
        }

        if(isset($row->to_who) && !empty($row->to_who)) {
            $toWho = explode(',', $row->to_who);
            if(in_array($request->email, $toWho)) {
                return redirect(url($shareUrl.base64UrlEncode($id.'|'.$request->email)));
            }

            return back()->withInput($request->only('email'))->with('error', __('Access not allowed.'));
        }
    }
}
