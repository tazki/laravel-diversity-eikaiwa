<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Http\CustomClass\KomojuApi;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserPayments;
use App\Models\ContactForms;
use Mail;
use Auth;
use DB;

class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->has('session_id') && !empty($request->session_id)) {
            $komojuData = KomojuApi::sessionGet($request->session_id);
            if(isset($komojuData->status) && !empty($komojuData->status)) {
                switch($komojuData->status) {
                    case 'completed':
                        $rowPaymentData['status'] = 2;
                    break;
                    case 'cancelled':
                        $rowPaymentData['status'] = 1;
                    break;
                }

                $condition['komoju_session_id'] = $request->session_id;
                $row = UserPayments::updateOrCreate($condition, $rowPaymentData);
                if(isset($row->user_id) && !empty($row->user_id)) {
                    $user = User::find($row->user_id);
                    // Login User with User Instance
                    Auth::login($user);
                    return redirect(route('student_profile').'?service=1');
                }
            }
        }

        return view('landing.home');
    }

    public function teacher()
    {
        $rows = User::where([
                ['user_type', '=', 'teacher'],
                ['status', '=', '1']
            ])
            ->select('*', 
                DB::raw('CONCAT(first_name, " ", last_name) as name'))
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('landing.teacher', compact('rows'));
    }

    public function teacherDetail($id)
    {
        $language_id = 1;
        if(App::currentLocale() == 'jp') {
            $language_id = 2;
        }

        $row = User::where('id', $id)
            ->select('*', 
                DB::raw('CONCAT(first_name, " ", last_name) as name'))
            ->first();
        if(is_object($row)) {
            $lang = UserDetails::where([
                ['user_id', '=', $id],
                ['language_id', '=', $language_id]
            ])->first();
        }

        return view('landing.teacher-detail', compact('row', 'lang'));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function pricing()
    {
        return view('landing.pricing');
    }

    public function contact(Request $request)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    // 'first_name' => 'required|string',
                    // 'last_name' => 'required|string',
                    'subject' => 'required|string',
                    'message' => 'required|string'
                ]
            );

            if($validator->fails()) {
                return back()->withInput($request->only('email', 'first_name', 'last_name', 'subject', 'message'))->withErrors($validator);
            }

            // $to_name = 'Oliver Rivera';
            // $to_email = 'oliverrivera09@gmail.com';
            // $name = $request->first_name.' '.$request->last_name;
            
            // $body = '<strong>Name:</strong> '. $name.'<br />';
            // $body .= '<strong>Email:</strong> '. $request->email.'<br />';
            // $body .= '<strong>Subject:</strong> '. $request->subject.'<br />';
            // $body .= '<strong>Message:</strong> '. $request->message;
            // $data['body'] = $body;
            // $data['name'] = $name;
            // Mail::send('emails.contact', $data, function($message) use ($to_name, $to_email) {
            //     $message->to($to_email, $to_name)->subject('Diversity Eikaiwa - Contact Form');
            //     $message->from(env('MAIL_USERNAME'), 'Diversity Eikaiwa Mailer');
            // });
            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['email'] = $request->email;
            $data['subject'] = $request->subject;
            $data['message'] = $request->message;
            ContactForms::create($data);
            return back()->with('success', __('Message Sent Successful!'));
        }

        return view('landing.contact');
    }

    public function termsCondition()
    {
        return view('landing.terms-condition');
    }

    public function register(Request $request)
    {
        $row['service'] = $request->service;
        return view('auth.register', compact('row'));
    }

    public function subscribe(Request $request)
    {
        // $data['email'] = 'tazki041@gmail.com';
        // $data['last_name'] = 'Bautista';
        // $data['first_name'] = 'Mark';
        // $data['month'] = 1;
        // $data['year'] = 26;
        // $data['number'] = '4111111111111111';
        // $komojuData = KomojuApi::createCustomer($data);
        // pr($komojuData);
        // $data['customer_id'] = '5mhr6yeplhw0rocp1wjhk60az';
        // $data['amount'] = 26;
        // $komojuData = KomojuApi::createSubscriptions($data);
        // pr($komojuData);
        // komoju_customer_id
        if($request->has('komojuToken') && !empty($request->komojuToken)) {
            $id = explode('|', urldecode(base64_decode($request->id)));
            $user_id = $id[0];
            $service_id = $id[1];
            // echo $request->komojuToken;
            // pr($id);
            // die;
            $row = User::where('id', '=', $user_id)->first();
            $rowPayment = UserPayments::where([
                ['user_id', '=', $user_id],
                ['service_id', '=', $service_id],
                ['status', '=', 0]
            ])->first();
            $customerData['email'] = $row->email;
            $customerData['komojuToken'] = $request->komojuToken;
            $komojuData = KomojuApi::createCustomer($customerData);
            // pr($komojuData);
            $subscribeData['customer_id'] = $komojuData->id;
            $subscribeData['amount'] = $rowPayment->service_price;
            $komojuData = KomojuApi::createSubscriptions($subscribeData);
            // pr($komojuData);

            $rowPaymentData['payment_data'] = json_encode($komojuData);
            $rowPaymentData['komoju_session_id'] = $komojuData->id; //subscription ID
            switch($komojuData->status) {
                case 'active':
                    $rowPaymentData['status'] = 2;
                break;
                case 'suspended':
                    $rowPaymentData['status'] = 1;
                break;
                // 0:pending	Initialized and ready to capture first payment.
                // 2:active	Captured previous payment and waiting for next interval.
                // 3:retrying	Failed to capture payment for interval.
                // 1:suspended	Suspended due to too many payment failures.
                // 4:deleted	Deleted by merchant.
            }
            $condition['id'] = $rowPayment->id;
            $row = UserPayments::updateOrCreate($condition, $rowPaymentData);
            $rowUserData['komoju_customer_id'] = $komojuData->customer->uuid;
            $condition['id'] = $user_id;
            $row = User::updateOrCreate($condition, $rowUserData);
            $user = User::find($user_id);
            // Login User with User Instance
            Auth::login($user);
            return redirect(route('student_profile').'?service=1');
        }
    }
    public function payment(Request $request)
    {
        if($request->has('id') && !empty($request->id)) {
            $id = explode('|', urldecode(base64_decode($request->id)));
            $user_id = $id[0];
            $service_id = $id[1];
            // $row = User::where('id', '=', $id)->first();
            // $rowPayment = UserPayments::where([
            //     ['user_id', '=', $id[0]],
            //     ['service_id', '=', $id[1]],
            //     ['status', '=', 0]
            // ])->first();
            // $orderNumber = 'DE'.$rowPayment->id;
            // $data['price'] = $rowPayment->service_price;
            // $data['id'] = $row->id;
            // $data['email'] = $row->email;
            // $data['name'] = $row->first_name.' '.$row->last_name;
            // $data['external_order_num'] = $orderNumber;

            // $komojuData = KomojuApi::hostedPage($data);
            // if(isset($komojuData->session_url) && !empty($komojuData->session_url)) {
            //     $rowPaymentData['order_number'] = $orderNumber;
            //     $rowPaymentData['payment_data'] = json_encode($komojuData);
            //     $rowPaymentData['komoju_session_id'] = $komojuData->id;
            //     $condition['id'] = $rowPayment->id;
            //     UserPayments::updateOrCreate($condition, $rowPaymentData);
            //     return redirect($komojuData->session_url);
            // }

            $row['id'] = $request->id;
            $row['service_id'] = $service_id;
            return view('landing.payment', compact('row'));
        }
    }
}
