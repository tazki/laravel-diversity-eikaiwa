<?php

namespace App\Http\Controllers\Student;

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
use App\Models\UserPayments;
use App\Models\UserBookings;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:web")->except('logoutStudent');
    }

    public static function studentdata()
    {
        return auth()->guard('web')->user();
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('s/login');
    }

    public function index()
    {
        echo 'student list here';
    }

    public function profile()
    {
        $rows['user'] = User::where('id', '=', Auth::user()->id)->first();
        $rowPayment = UserPayments::where('user_id', '=', Auth::user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        if(isset($rowPayment[0]) && isset($rowPayment[0]->service_id)) {
            switch($rowPayment[0]->service_id) {
                case 3:
                    $rows['payment']['price'] = 13310;
                    $rows['payment']['price_label'] = '¥13,310';
                    $rows['payment']['points'] = 8;
                    $rows['payment']['service'] = __('Plan B');
                break;
                case 2:
                    $rows['payment']['price'] = 7480;
                    $rows['payment']['price_label'] = '¥7,480';
                    $rows['payment']['points'] = 4;
                    $rows['payment']['service'] = __('Plan A');
                break;
                default:
                    $rows['payment']['price'] = 0;
                    $rows['payment']['price_label'] = '¥0';
                    $rows['payment']['points'] = 1;
                    $rows['payment']['service'] = __('Trial');
                break;
            }

            switch($rowPayment[0]->status) {
                case 2:
                    $rows['payment']['status'] = __('Completed');
                break;
                case 1:
                    $rows['payment']['status'] = __('Cancelled');
                break;
                default:
                    $rows['payment']['status'] = __('Pending');
                break;
            }

            if(!empty($rowPayment[0]->payment_data)) {
                $payment_data = json_decode($rowPayment[0]->payment_data);
                if($rowPayment[0]->status == 0) {
                    $rows['payment']['session_url'] = $payment_data->session_url;
                }
            }
        }

        $rows['activePoints'] = studentActivePoints();
        $rows['tab'] = (isset(request()->service)) ? 'subscription' : '';
        return view('student.profile', compact('rows'));
    }
    
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:255'],
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