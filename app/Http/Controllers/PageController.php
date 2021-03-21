<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\CustomClass\KomojuApi;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserPayments;
use Mail;
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
                UserPayments::updateOrCreate($condition, $rowPaymentData);
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

    public function payment(Request $request)
    {
        if($request->has('id') && !empty($request->id)) {
            $id = explode('|', urldecode(base64_decode($request->id)));
            $row = User::where('id', '=', $id)->first();
            $rowPayment = UserPayments::where([
                ['user_id', '=', $id[0]],
                ['service_id', '=', $id[1]],
                ['status', '=', 0]
            ])->first();
            $orderNumber = 'DE'.$rowPayment->id;
            $data['price'] = $rowPayment->service_price;
            $data['id'] = $row->id;
            $data['email'] = $row->email;
            $data['name'] = $row->first_name.' '.$row->last_name;
            $data['external_order_num'] = $orderNumber;

            $komojuData = KomojuApi::hostedPage($data);
            if(isset($komojuData->session_url) && !empty($komojuData->session_url)) {
                $rowPaymentData['order_number'] = $orderNumber;
                $rowPaymentData['payment_data'] = json_encode($komojuData);
                $rowPaymentData['komoju_session_id'] = $komojuData->id;
                $condition['id'] = $rowPayment->id;
                UserPayments::updateOrCreate($condition, $rowPaymentData);
                return redirect($komojuData->session_url);
            }
        }
    }
}
