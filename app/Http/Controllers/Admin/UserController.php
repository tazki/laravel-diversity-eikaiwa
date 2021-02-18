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
use App\Organization;

class UserController extends Controller
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
        if ($request->ajax()) {
            // $data = DB::table('organizations')
            // ->select(
            //     'organizations.*',
            //     'users.email',
            //     DB::raw('DATE_FORMAT(mt_organizations.updated_at, "%M %d, %Y") as updated_at'),
            //     DB::raw('CONCAT(mt_organizations.first_name, " ", mt_organizations.last_name) as name'),
            //     // DB::raw('IF(mt_organizations.status=1, "Active", "Inactive") as status')
            //     DB::raw('IF(mt_organization_payments.service=2, "Business", "Free") as service') //Unlimited
            // )
            // ->leftJoin('users', 'organizations.id', '=', 'users.organization_id') // Query returns all products irrespective of the user
            // ->leftJoin('organization_payments', 'organization_payments.id', '=', 'organizations.id')
            // ->orderByRaw('mt_organizations.created_at DESC')
            // ->get();

            // // if no return data
            // if(empty(sizeof($data))) {
            //     $data['data'] = array();
            //     return $data;
            // }

            $data[0]['id'] = 1;
            $data[0]['name'] = 'Alvin Cruz';
            $data[0]['mobile_number'] = '123456789';
            $data[0]['email'] = 'alvin@gmail.com';
            $data[0]['service'] = 'Silver';
            $data[0]['updated_at'] = 'January 01, 2021';
            $data[0]['status'] = 'Active';

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
                // ->addColumn('action', function($row) {
                //     $btn = '<a class="btn btn-sm btn-icon btn-secondary" onClick="ajaxFetch(this); return false;" title="'.__('Edit Client').'" data-url="'.route('client.edit', $row->id).'" data-update="'.url('/client/'.$row->id.'/update').'" data-toggle="modal" data-target="#clientFormModal"><i class="fa fa-pencil-alt"></i></a>';
                //     $btn .= '<a class="js-btn-delete btn btn-sm btn-icon btn-secondary " data-toggle="modal" data-target="#deleteModal" data-deleteurl="'.route('client.destroy', $row->id).'" href="#"><i class="far fa-trash-alt"></i></a>';
                //     return $btn;
                // })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('admin.user-list');
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