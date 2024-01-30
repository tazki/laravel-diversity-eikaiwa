<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use App\Models\UserBookings;
use Carbon\Carbon;
use Auth;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $rows = array();
        $rows['total_class'] = UserBookings::where([
            ['teacher_id', '=', Auth::user()->id],
            ['status', '=', 3]
        ])
        ->count('*');
        
        $rows['total_class_of_the_month'] = UserBookings::where([
                ['teacher_id', '=', Auth::user()->id],
                ['status', '=', 3]
            ])
            // ->whereRaw('DATE_FORMAT(booking_date, "%m-%Y")', Carbon::today()->format('m-Y'))
            ->count('*');

        return view('teacher.dashboard', compact('rows'));
    }
}
