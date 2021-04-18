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
use App\Models\ContactForms;

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
            ->orderBy('id', 'desc')
            ->get();

        if(isset($rowPayment[0]) && isset($rowPayment[0]->service_id)) {
            $service = currentService($rowPayment[0]->service_id);
            $rows = array_merge($rows, $service);

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

            // if(!empty($rowPayment[0]->payment_data)) {
            //     $payment_data = json_decode($rowPayment[0]->payment_data);
            //     if($rowPayment[0]->status == 0) {
            //         $rows['payment']['session_url'] = $payment_data->session_url;
            //     }
            // }

            if(empty($rowPayment[0]->status)) {
                $rows['has_upgrade_request'] = $rowPayment[0]->service_id;
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
                'skype_id' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'postal_code' => ['required', 'string', 'max:255'],
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
            'mobile_number' => $request->mobile_number,
            'skype_id' => $request->skype_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code
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

    public function planUpgrade(Request $request)
    {
        $service = currentService($request->service_id);
        // $row = User::where('id', '=', Auth::user()->id)->first();
        // $data['service_id'] = $request->service_id;
        // $data['student_id'] = $row->id;
        // $data['first_name'] = $row->first_name;
        // $data['last_name'] = $row->last_name;
        // $data['email'] = $row->email;
        // ContactForms::create($data);

        $paymentData['user_id'] = Auth::user()->id;
        $paymentData['service_price'] = $service['payment']['price'];
        $paymentData['service_points'] = $service['payment']['points'];
        $paymentData['service_id'] = $request->service_id;
        $paymentData['status'] = ($request->service_id == 1) ? 2 : 0;
        UserPayments::create($paymentData);
        return redirect(route('page_subscription', ['id' => urlencode(base64_encode(Auth::user()->id.'|'.$request->service_id))]));
    }
}