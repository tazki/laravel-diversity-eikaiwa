<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserPayments;
use Mail;

class CustomSignupController extends Controller
{
    public function addUser(Request $request)
    {
        $validationSetting = array(
            'agree' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name_furigana' => ['required', 'string', 'max:255'],
            'last_name_furigana' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'skype_id' => ['string', 'max:255']
        );
        $cleanData = request()->validate($validationSetting);
        $cleanData['status'] = 1;
        $cleanData['user_type'] = 'student';
        $cleanData['password'] = Hash::make($cleanData['password']);
        unset($cleanData['agree']);
        $user = User::create($cleanData);
        if(isset($user->id)) {
            $service = currentService(request()->service);

            $paymentData['user_id'] = $user->id;
            $paymentData['service_price'] = $service['payment']['price'];
            $paymentData['service_points'] = $service['payment']['points'];
            $paymentData['service_id'] = request()->service;
            $paymentData['status'] = (request()->service == 1) ? 2 : 0;
            UserPayments::create($paymentData);

            $to_email =  $cleanData['email'];
            $to_name = $cleanData['first_name'].' '.$cleanData['last_name'];
            $emailData['name'] = $to_name;
            Mail::send('emails.signup', $emailData, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('アカウント登録完了のお知らせ(ダイバーシティ英会話)');
                $message->from(env('MAIL_USERNAME'), 'Diversity Eikaiwa Mailer');
                $message->bcc('oliverrivera09@gmail.com', 'Oliver');
                $message->bcc('tazki04@gmail.com', 'Mark');
                $message->attach(Storage::disk('public')->path('マイページガイド.pdf'));
            });

            if(request()->service == 1) {
                // return back()->with('success','Student registered successfully!');
                return redirect(route('page_login'));
            } elseif(in_array(request()->service, array(2,3,4,5))) {
                // Login User with User Instance
                \Auth::login($user);
                return redirect(route('page_subscription', ['id' => urlencode(base64_encode($user->id.'|'.request()->service))]));
            }
        } else {
            return back()->with('success','Failed to register this time.');
        }
    }
}