<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use DataTables;
use Auth;
use DB;
use App\Models\UseBookings;

class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return view('student.schedule');
    }

    public function calendar(Request $request)
    {
        // $clients = UseBookings::getClient(Auth::user()->id, 'created_at DESC');
        $query[] = array('user_bookings.student_id', '=', Auth::user()->id);
        $data = DB::table('user_bookings')
            ->select(
                'user_bookings.*',
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%Y-%m-%d") as ymd_booking_date'),
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
                    $rows[$count]['id'] = $item->id;
                    $rows[$count]['title'] = $item->task_name;
                    $rows[$count]['description'] = $item->task_description;
                    // $rows[$count]['url'] = $item->id;
                    $rows[$count]['start'] = $item->booking_date;
                    $rows[$count]['chat_url'] = '<a href="#" class="js-btn-add" onClick="window.ajaxFetchTemplate(this); return false;" data-title="'.$item->task_name.' '.__('Chat').'" data-url="'.url('client/task/'.$item->id.'/chat').'" data-update="'.url('client/task/'.$item->id.'/chat').'" data-toggle="modal" data-target="#clientTaskChatFormModal"><span><i class="far fa-fw fa-comment-alt"></i> '.__('Chat').'</span></a>';

                    switch($item->status) {
                        case 3:
                            $rows[$count]['status'] = __('Close');
                            $className = 'task-schedule-done';
                        break;
                        case 2:
                            $rows[$count]['status'] = __('In Progress');
                            $className = 'task-schedule-progress';
                        break;
                        case 1:
                            $rows[$count]['status'] = __('Open');
                        break;
                    }

                    $className = '';
                    $booking_date = Carbon::parse($item->ymd_booking_date);
                    $now = Carbon::today()->format('Y-m-d');
                    if($booking_date->lessThan($now) || Carbon::today()->format('Y-m-d') == $item->ymd_booking_date) {
                        $className = 'task-schedule-overdue';
                    }

                    if($booking_date->floatDiffInDays($now) > 7) {
                        $className = 'task-schedule-week-ago';
                    }
                    $rows[$count]['className'] = $className;

                    $rows[$count]['to_who'] = '';
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

            if($request->confirm_first) {
                return response()->json([
                    'notify' => 'inline',
                    'status' => 'success',
                    'action' => 'confirm'
                ]);
            }

            $custom_id = 1;
            $lastInsertTask = ClientTask::where('organization_folder_id', '=', $request->folder_id)->orderBy('custom_id', 'DESC')->first();
            if(isset($lastInsertTask->custom_id)) {
                $custom_id = $lastInsertTask->custom_id + 1;
            }

            $client = ClientTask::create([
                'custom_id' => $custom_id,
                'parent_id' => $request->parent_id,
                'organization_folder_id' => $request->folder_id,
                'organization_id' => Auth::user()->organization_id,
                'client_id' => Auth::user()->id,
                'task_name' => $request->task_name,
                'task_description' => $request->task_description,
                'owner_client_user' => Auth::user()->id,
                'to_who' => $request->to_who,
                'status' => 1,
                'due_date' => $request->due_date
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
}