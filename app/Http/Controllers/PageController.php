<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\CustomClass\KomojuApi;
use App\Models\User;
use App\Models\UserDetails;
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
