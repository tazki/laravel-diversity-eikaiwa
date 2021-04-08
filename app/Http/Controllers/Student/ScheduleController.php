<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DataTables;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserBookings;
use App\Models\TeacherAvailability;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $rows['teachers'] = User::where([
                ['user_type', '=', 'teacher'],
                ['status', '=', 1]
            ])->select('*', DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as name'))
            ->get();
        
        $rows['teachers_availability'] = array();
        foreach($rows['teachers'] as $item) {
            $days = array(0,1,2,3,4,5,6);
            $availability = TeacherAvailability::where([
                ['teacher_id', '=', $item->id],
                ['status', '=', 1]
            ])->get();
            if(is_object($availability)) {
                foreach($availability as $item2) {
                    $rows['teachers_availability'][$item->id]['availableDay'][$item2->id]['day'] = $item2->day;
                    $rows['teachers_availability'][$item->id]['availableDay'][$item2->id]['start_time'] = $item2->start_time;
                    $rows['teachers_availability'][$item->id]['availableDay'][$item2->id]['end_time'] = $item2->end_time;
                    unset($days[$item2->day]);
                }
            }
            $rows['teachers_availability'][$item->id]['notAvailableDay'] = (sizeof($days) > 0) ? json_encode($days) : '';
        }
        pr($rows['teachers_availability']);
        
        

        return view('student.schedule', compact('rows'));
    }

    public function calendar(Request $request)
    {
        $query[] = array('user_bookings.student_id', '=', Auth::user()->id);
        $data = DB::table('user_bookings')
            ->select(
                'user_bookings.*',
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%Y-%m-%d") as ymd_booking_date'),
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%M %d, %Y %H:%i") as label_booking_date'),
                DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as teacher_name'),
            )
            ->leftJoin('users', 'users.id', '=', 'user_bookings.teacher_id')
            ->where($query)
            ->orderByRaw('mt_user_bookings.created_at DESC')
            ->get();
        if(is_object($data)) {
            $rows = array();
            $count = 0;
            foreach($data as $item) {
                if(!empty($item->booking_date)) {
                    $booking_end_date = Carbon::parse($item->ymd_booking_date)->addHour();

                    $rows[$count]['deleteurl'] = route('student_schedule_cancel_class', ['id' => $item->id]);
                    $rows[$count]['id'] = $item->id;
                    $rows[$count]['teacher_id'] = $item->teacher_id;
                    $rows[$count]['title'] = $item->teacher_name.' sensei';
                    $rows[$count]['label_booking_date'] = $item->label_booking_date;
                    // $rows[$count]['description'] = $item->task_description;
                    // $rows[$count]['url'] = $item->id;
                    $rows[$count]['start'] = $item->booking_date;
                    $rows[$count]['end'] = $booking_end_date;
                    // $rows[$count]['chat_url'] = '<a href="#" class="js-btn-add" onClick="window.ajaxFetchTemplate(this); return false;" data-title="'.$item->task_name.' '.__('Chat').'" data-url="'.url('client/task/'.$item->id.'/chat').'" data-update="'.url('client/task/'.$item->id.'/chat').'" data-toggle="modal" data-target="#clientTaskChatFormModal"><span><i class="far fa-fw fa-comment-alt"></i> '.__('Chat').'</span></a>';

                    $className = '';
                    $rows[$count]['status'] = $item->status;
                    switch($item->status) {
                        case 5:
                        case 4:
                            $className = 'task-schedule-overdue';
                        break;
                        case 3:
                            // $rows[$count]['status'] = __('Close');
                            $className = 'task-schedule-done';
                        break;
                        case 2:
                            // $rows[$count]['status'] = __('In Progress');
                            $className = 'task-schedule-progress';
                        break;
                    }
                    // $booking_date = Carbon::parse($item->ymd_booking_date);
                    // $now = Carbon::today()->format('Y-m-d');
                    // if($booking_date->lessThan($now) || Carbon::today()->format('Y-m-d') == $item->ymd_booking_date) {
                    //     $className = 'task-schedule-overdue';
                    // }

                    // if($booking_date->floatDiffInDays($now) > 7) {
                    //     $className = 'task-schedule-week-ago';
                    // }
                    $rows[$count]['className'] = $className;

                    // $rows[$count]['to_who'] = '';
                    // if(!empty($item->to_who)) {
                    //     $to_who = '';
                    //     $toWho = explode(',', $item->to_who);

                    //     foreach($clients as $client) {
                    //         if(in_array($client->id, $toWho)) {
                    //             $comma = (!empty($to_who)) ? ', ' : '';
                    //             $to_who .= $comma.$client->teacher_name;
                    //         }
                    //     }
                    //     $rows[$count]['to_who'] = $to_who;
                    // }

                    $count++;
                }
            }

            return $rows;
        }
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(),
                [
                    'teacher_id' => 'required',
                    'booking_date' => 'required'
                ]
            );

            if($validator->fails()) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'danger',
                    'message' => $validator->errors()//->all()
                ]);
            }

            $bookedSlots = UserBookings::where([
                ['booking_date', '=', $request->booking_date.':00'],
                ['teacher_id', '=', $request->teacher_id]
            ])->first();
            if(is_object($bookedSlots) && isset($bookedSlots->id)) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'danger',
                    'message' => __('Date is not available')
                ]);
            }

            if($request->confirm_first) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'success',
                    'action' => 'confirm'
                ]);
            }            

            $row = UserBookings::create([
                'teacher_id' => $request->teacher_id,
                'student_id' => Auth::user()->id,
                'booking_date' => $request->booking_date,
                'status' => 1
            ]);

            $msg = array(
                'notify' => 'inline',
                'status'  => 'success',
                'message' => __('Data saved successfully!'),
                'action' => 'reload'
            );
            return response()->json($msg);
        }
    }

    public function cancelClass()
    {
        $rowUserData = [
            'status' => 4
        ];
        $condition['student_id'] = Auth::user()->id;
        $rowId = UserBookings::updateOrCreate($condition, $rowUserData);

        return back()->with('success','Class Cancel successfully!');
    }
}