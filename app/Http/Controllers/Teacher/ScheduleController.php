<?php

namespace App\Http\Controllers\Teacher;

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
use Mail;
use DB;
use App\Models\User;
use App\Models\UserBookings;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $rows['teachers'] = User::where([
                ['user_type', '=', 'teacher'],
                ['status', '=', 1]
            ])->select('*', DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as name'))
            ->get();

        return view('teacher.schedule', compact('rows'));
    }

    public function calendar(Request $request)
    {
        $query[] = array('user_bookings.teacher_id', '=', TeacherController::teacherdata()->id);
        $data = DB::table('user_bookings')
            ->select(
                'user_bookings.*',
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%Y-%m-%d") as ymd_booking_date'),
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%M %d, %Y %H:%i") as label_booking_date'),
                DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as student_name'),
            )
            ->leftJoin('users', 'users.id', '=', 'user_bookings.student_id')
            ->where($query)
            ->orderByRaw('mt_user_bookings.created_at DESC')
            ->get();
        if(is_object($data)) {
            $rows = array();
            $count = 0;
            foreach($data as $item) {
                if(!empty($item->booking_date)) {
                    $booking_end_date = Carbon::parse($item->ymd_booking_date)->addHour();

                    $rows[$count]['id'] = $item->id;
                    $rows[$count]['title'] = $item->student_name;
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

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(),
                [
                    'status' => 'required'
                ]
            );

            if($validator->fails()) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'danger',
                    'message' => $validator->errors()//->all()
                ]);
            }

            if($request->confirm_first) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'success',
                    'action' => 'confirm'
                ]);
            }            

            $rowUserData = [
                'status' => $request->status
            ];

            
            // Student Status
            switch($request->status) {
                case 1:
                    $studentStatusLabel = __('Request Class Schedule');
                break;
                case 2:
                    $studentStatusLabel = __('Accept Class Schedule');
                break;
                case 3:
                    $studentStatusLabel = __('Class Done');
                break;
                case 4:
                    $studentStatusLabel = __('Class Cancel By Student');
                break;
                case 5:
                    $studentStatusLabel = __('Class Cancel By Teacher');
                break;
            }

            $condition['id'] = $request->id;
            $rowId = UserBookings::updateOrCreate($condition, $rowUserData);

            $studentRow = User::where('id', $rowId->student_id)->first();
            $teacherRow = User::where('id', Auth::user()->id)->first();
            $to_name = $studentRow->first_name.' '.$studentRow->last_name; // Student Name
            $to_email = $studentRow->email; // Student Email
            $body = '<strong>Teacher Name:</strong> '. $teacherRow->first_name.' '.$teacherRow->last_name.'<br />';
            $body .= '<strong>Skype ID:</strong> '. $teacherRow->skype_id.'<br />';
            $body .= '<strong>Booking Date:</strong> '. $rowId->booking_date.'<br />';
            $body .= '<strong>Booking Status:</strong> '. $studentStatusLabel;
            $emailData['body'] = $body;
            Mail::send('emails.plain', $emailData, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Diversity Eikaiwa - Class Request');
                $message->from(env('MAIL_USERNAME'), 'Diversity Eikaiwa Mailer');
                $message->bcc('tazki04@gmail.com', 'Mark');
            });

            $msg = array(
                'notify' => 'inline',
                'status'  => 'success',
                'message' => __('Data saved successfully!'),
                'action' => 'reload'
            );
            return response()->json($msg);
        }
    }
}