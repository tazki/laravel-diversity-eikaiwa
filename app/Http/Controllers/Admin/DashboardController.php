<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Client;

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
        // $total_number_of_customers = Organization::get();
        $rows['total_number_of_customers'] = 64;//$total_number_of_customers->count();
        // $total_number_of_user = Client::get();
        $rows['total_number_of_user'] = 100;//$total_number_of_user->count();
        // $total_number_of_active_customers = Organization::where('status', '=', 1)->get();
        $rows['total_number_of_active_customers'] = 50;//$total_number_of_active_customers->count();
        // $new_customer_registration = DB::table('organizations')
        //     ->select(
        //         DB::raw('DATE_FORMAT(mt_organizations.created_at, "%d %b") as created_at')
        //     )
        //     ->orderByRaw('mt_organizations.created_at ASC')
        //     ->whereMonth('organizations.created_at', Carbon::now()->month)
        //     ->get();
        // if(is_object($new_customer_registration)) {
        //     $new_customer_registration_chart = array();
        //     $new_customer_registration_chart_partial = array();
        //     foreach($new_customer_registration as $item) {
        //         $new_customer_registration_chart_partial[$item->created_at][] = $item->created_at;
        //     }
        //     foreach($new_customer_registration_chart_partial as $key => $val) {
        //         $new_customer_registration_chart['date'][] = $key;
        //         $new_customer_registration_chart['count'][] = sizeof($val);
        //     }

        //     if(isset($new_customer_registration_chart['date'])) {
                $new_customer_registration_chart['date'] = array('2020-09', '2020-10', '2020-11', '2020-12');
                $new_customer_registration_chart['count'] = array(10, 25, 18, 11);
                $rows['new_customer_registration']['date'] = json_encode($new_customer_registration_chart['date']);
                $rows['new_customer_registration']['count'] = json_encode($new_customer_registration_chart['count']);
        //     }
        // }

        return view('admin.dashboard', compact('rows'));
    }
}
