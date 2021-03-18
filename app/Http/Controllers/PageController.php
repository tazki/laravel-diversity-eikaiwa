<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\CustomClass\KomojuApi;
use App\Models\User;
use App\Models\UserDetails;
use Mail;
use DB;

class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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

    public function register()
    {
        return view('auth.register');
    }

    public function payment()
    {
        $shop = KomojuApi::accessToken();
    }
}
