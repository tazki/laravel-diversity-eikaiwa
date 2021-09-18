<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
use Mail;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserBookings;
use App\Models\TeacherAvailability;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('user_bookings')
                ->select(
                    'user_bookings.*',
                    DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%Y-%m-%d") as ymd_booking_date'),
                    DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%M %d, %Y %H:%i") as label_booking_date'),
                    DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as teacher_name'),
                )
                ->leftJoin('users', 'users.id', '=', 'user_bookings.teacher_id')
                ->where('user_bookings.student_id', Auth::user()->id)
                ->orderByRaw('mt_user_bookings.created_at DESC')
                ->get();

            // if no return data
            if(empty(sizeof($data))) {
                $data['data'] = array();
                return $data;
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('review', function($row) {
                    $stars = '';
                    for($i=1; $i<=5; $i++) {
                        $stars .= '<i class="fa fa-star text-yellow"></i>';
                        // <i class="far fa-star text-yellow"></i>
                    }

                    return '<div class="my-1">'.$stars.'</div>';
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('teachers_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
                    // $btn .= '<a class="js-btn-delete btn btn-sm btn-icon btn-secondary " data-toggle="modal" data-target="#deleteModal" data-deleteurl="" href="#"><i class="far fa-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['review','action'])
                ->make(true);
        }
        
        $row = array();
        return view('student.review', compact('row'));
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
                    'booking_date' => 'required',
                    'booking_time' => 'required'
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
                ['booking_date', '=', $request->booking_date.' '.$request->booking_time.':00'],
                ['teacher_id', '=', $request->teacher_id],
                ['status', '!=', 4],
                ['status', '!=', 5]
            ])->first();
            if(is_object($bookedSlots) && isset($bookedSlots->id)) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'danger',
                    'message' => __('Date is not available')
                ]);
            }

            $dayOfWeek = Carbon::parse($request->booking_date)->dayOfWeek;
            // $selectedHour = Carbon::parse($request->booking_date)->hour;
            $selectedHour = $request->booking_time;
            $availability = TeacherAvailability::where([
                ['teacher_id', '=', $request->teacher_id],
                ['day', '=', $dayOfWeek],
                ['status', '=', 1]
            ])->first();

            if(isset($availability->start_time) && isset($availability->end_time)) {
                $startTime = Carbon::parse($availability->start_time)->hour;
                $endTime = Carbon::parse($availability->end_time)->hour;

                if($selectedHour < $startTime || $selectedHour > $endTime) {
                    return response()->json([
                        'notify' => 'inline',
                        'status' => 'danger',
                        'message' => __('Teacher is not available')
                    ]);
                }
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
                'booking_date' => $request->booking_date.' '.$request->booking_time,
                'status' => 1
            ]);

            $studentRow = User::where('id', Auth::user()->id)->first();
            $teacherRow = User::where('id', $request->teacher_id)->first();
            $to_name = $teacherRow->first_name.' '.$teacherRow->last_name; // Teacher Name
            $to_email = $teacherRow->email; // Teacher Email
            $body = '<strong>Student Name:</strong> '. $studentRow->first_name.' '.$studentRow->last_name.'<br />';
            $body .= '<strong>Skype ID:</strong> '. $studentRow->skype_id.'<br />';
            $body .= '<strong>Booking Date:</strong> '. $request->booking_date;
            $emailData['body'] = $body;
            Mail::send('emails.plain', $emailData, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Diversity Eikaiwa - Class Request');
                $message->from(env('MAIL_USERNAME'), 'Diversity Eikaiwa Mailer');
                $message->bcc('oliverrivera09@gmail.com', 'Oliver');
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

    public function cancelClass($id)
    {
        $rowUserData = [
            'status' => 4
        ];
        $condition['id'] = $id;
        $rowId = UserBookings::updateOrCreate($condition, $rowUserData);

        return back()->with('success','Class Cancel successfully!');
    }
}