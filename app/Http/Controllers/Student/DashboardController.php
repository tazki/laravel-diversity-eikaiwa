<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Auth;
use App\Models\UserPayments;
use App\Models\UserBookings;

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
        $rows['total_remaining_points'] = studentActivePoints();

        $rows['total_class_taken'] = UserBookings::where('student_id', '=', Auth::user()->id)
            ->whereIN('status', array(3))
            ->count();

        $rowPayment = UserPayments::where('user_id', '=', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        if(isset($rowPayment[0]) && isset($rowPayment[0]->service_id)) {
            $service = currentService($rowPayment[0]->service_id);
        }
        $rows['current_subscription'] = $service['payment']['service'];

        $new_customer_registration_chart['date'] = array('2020-09', '2020-10', '2020-11', '2020-12');
        $new_customer_registration_chart['count'] = array(10, 25, 18, 11);
        $rows['new_customer_registration']['date'] = json_encode($new_customer_registration_chart['date']);
        $rows['new_customer_registration']['count'] = json_encode($new_customer_registration_chart['count']);

        return view('student.dashboard', compact('rows'));
    }
}
