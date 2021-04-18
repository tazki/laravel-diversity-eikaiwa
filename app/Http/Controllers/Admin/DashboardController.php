<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\User;
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
        $rows['total_number_of_user'] = User::where('user_type', 'student')->count();
        $rows['total_number_of_booking'] = UserBookings::count();
        $rows['total_number_of_completed_class'] = UserBookings::where('status', 3)->count();
        $rows['total_number_of_active_customers'] = $total_number_of_active_customers = User::where([
                ['users.user_type', '=', 'student'],
                ['subscriptions.stripe_status', '=', 'active']
            ])
            ->leftJoin('subscriptions', 'subscriptions.user_id', '=', 'users.id')
            ->count(DB::raw('DISTINCT mt_users.id'));

        $studentRows = User::where('user_type', 'student')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as register_at')
            )
            ->get();
        if(is_object($studentRows)) {
            $new_customer_registration = array();
            $new_customer_registration_chart = array();
            foreach($studentRows as $key => $row) {
                $new_customer_registration[$row->register_at][$key] = $key;
            }

            if(is_array($new_customer_registration) && sizeof($new_customer_registration) > 0) {
                $count = 0;
                foreach($new_customer_registration as $date => $val) {
                    $new_customer_registration_chart['date'][$count] = $date;
                    $new_customer_registration_chart['count'][$count] = sizeof($val);
                    $count++;
                }

                $rows['new_customer_registration']['date'] = 0;
                $rows['new_customer_registration']['count'] = 0;
                if(isset($new_customer_registration_chart['date'])) {
                    $rows['new_customer_registration']['date'] = json_encode($new_customer_registration_chart['date']);
                    $rows['new_customer_registration']['count'] = json_encode($new_customer_registration_chart['count']);
                }
            }
        }

        $teacherRows = User::where('user_type', 'teacher')
            ->whereIn('user_bookings.status', [3,4,5])
            ->select(
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.avatar',
                'user_bookings.status'
            )
            ->leftJoin('user_bookings', 'user_bookings.teacher_id', '=', 'users.id')
            ->get();
        if(is_object($teacherRows)) {
            $teacher_leaderboard = array();
            foreach($teacherRows as $key => $row) {
                $teacher_leaderboard[$row->id]['id'] = $row->id;
                $teacher_leaderboard[$row->id]['name'] = $row->first_name.' '.$row->last_name;
                $teacher_leaderboard[$row->id]['avatar'] = userFile($row->avatar, '', $row->id);
                $teacher_leaderboard[$row->id]['booking_status'][$row->status][] = $row->status;
                $teacher_leaderboard[$row->id]['total_booking'][] = $row->status;
            }

            foreach($teacher_leaderboard as $key => $row) {
                $totalBooking = sizeof($row['total_booking']);
                $teacher_leaderboard[$key]['total_booking'] = $totalBooking;

                foreach($row['booking_status'] as $skey => $srow) {
                    $teacher_leaderboard[$key]['booking_status_count'][$skey] = sizeof($srow);
                    $teacher_leaderboard[$key]['booking_status_percent'][$skey] = (sizeof($srow) / $totalBooking) * 100;
                }
            }

            $rows['teacher_leaderboard'] = $teacher_leaderboard;
        }

        $rows['bookingStatusColor'] = array(
            '3' => 'purple',
            '4' => 'teal',
            '5' => 'red'
        );
        return view('admin.dashboard', compact('rows'));
    }
}
