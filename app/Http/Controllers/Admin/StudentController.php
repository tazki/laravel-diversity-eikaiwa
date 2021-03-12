<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
use DataTables;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserDetails;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('user_type', 'student')
            ->select('*', 
                DB::raw('CONCAT(first_name, " ", last_name) as name'),
                DB::raw('DATE_FORMAT(updated_at, "%M %d, %Y") as updated_at'))
            ->orderBy('updated_at', 'desc')
            ->get();

            // if no return data
            if(empty(sizeof($data))) {
                $data['data'] = array();
                return $data;
            }

            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function($row) {
                //     $checked = ($row->status==1) ? 'checked="checked"' : '';
                //     return '<div class="switch-wrapper">
                //         <!--div class="d-inline-block mr-2">Inactive</div-->
                //         <label class="js-status-switcher-control switcher-control">
                //             <input type="checkbox" class="switcher-input" value="'.$row->status.'" '.$checked.' onClick="window.ajaxSingle(this)" data-update="'.url('admin/users/'.$row->id.'/status').'" data-disable="switcher-input">
                //             <span class="switcher-indicator"></span>
                //         </label>
                //         <!--div class="d-inline-block ml-2">Active</div-->
                //     </div>';
                // })
                ->addColumn('action', function($row) {
                    // $btn = '<a href="'.route('teachers_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
                    // $btn .= '<a class="js-btn-delete btn btn-sm btn-icon btn-secondary " data-toggle="modal" data-target="#deleteModal" data-deleteurl="" href="#"><i class="far fa-trash-alt"></i></a>';
                    // return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.student-list');
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')) {
            
        }
        return view('admin.student-edit');
    }

    public function status(Request $request)
    {
        if(!isset($request->id) && empty($request->id)) {
            return response()->json([
                'notify' => 'inline',
                'status' => 'danger',
                'message' => __('Invalid Data Sent')
            ]);
        }

        $status = 1;
        if($request->status_id == 1) {
            $status = 0;
        }

        $clientData = [
            'status' => $status
        ];
        $condition['id'] = $request->id;
        Organization::updateOrCreate($condition, $clientData);

        $msg = array(
            'status'  => 'success',
            'message' => __('Status updated successfully!')
        );
        return response()->json($msg);
    }
}