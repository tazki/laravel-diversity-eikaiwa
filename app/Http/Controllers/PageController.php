<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\CustomClass\KomojuApi;

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
        return view('landing.teacher');
    }

    public function about()
    {
        return view('landing.about');
    }

    public function pricing()
    {
        return view('landing.pricing');
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function payment()
    {
        $shop = KomojuApi::accessToken();
    }
}
