<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Auth;
use DB;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:admin")->except('logoutAdmin');
    }

    public static function admindata()
    {
        return auth()->guard('admin')->user();
    }

    public function logoutAdmin()
    {
    	Auth::guard('admin')->logout();
    	return redirect('admin/login');
    }

    public function index()
    {
        echo 'admin list here';
    }

    public function profile()
    {
        $rows['user'] = User::where('id', '=', Auth::user()->id)->first();
        return view('admin.profile', compact('rows'));
    }
    
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'mobile_number' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users','email')->ignore(Auth::user()->id),
                ],
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'notify' => 'inline',
                'status' => 'danger',
                'message' => $validator->errors()//->all()
            ]);
        }

        if($request->confirm_first) {
            return response()->json([
                'notify' => 'inline',
                'status' => 'success',
                'action' => 'confirm'
            ]);
        }

        $userRow = User::find(Auth::user()->id);
        $avatar = $userRow->avatar; 
        if ($request->hasFile('avatar') && !empty($request->file('avatar'))) {
            $avatar = fileUpload('avatar', $avatar, Auth::user()->id);
        }

        $rowUserData = [
            'avatar' => $avatar,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_number' => $request->mobile_number
        ];
        $condition['id'] = Auth::user()->id;
        $rowId = User::updateOrCreate($condition, $rowUserData);

        $msg = array(
            'notify' => 'popup',
            'status'  => 'success',
            'message' => __('Data saved successfully!'),
            'action' => 'reload'
        );
        return response()->json($msg);
    }

    public function profilePassword(Request $request)
    {   
        $validator = Validator::make($request->all(),
            [
                'current_password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'notify' => 'inline',
                'status' => 'danger',
                'message' => $validator->errors()//->all()
            ]);
        }

        $user = User::where('id', '=', Auth::user()->id)->first();
        if(!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'notify' => 'inline',
                'status' => 'danger',
                'message' => array('current_password' => 'Current Password is not correct.')
            ]);
        }

        if($request->confirm_first) {
            return response()->json([
                'notify' => 'inline',
                'status' => 'success',
                'action' => 'confirm'
            ]);
        }

        $rowData = [
            'password' => Hash::make($request->password)
        ];
        $condition['id'] = Auth::user()->id;
        $rowId = User::updateOrCreate($condition, $rowData);

        $msg = array(
            'notify' => 'popup',
            'status'  => 'success',
            'message' => __('Password saved successfully!'),
            'action' => 'hideModal'
        );
        return response()->json($msg);
    }
}