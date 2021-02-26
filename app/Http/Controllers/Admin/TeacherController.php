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
use App\User;
use App\UserDetails;

class TeacherController extends Controller
{
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
            $data[0]['name'] = 'Rossel Sensei';
            $data[0]['mobile_number'] = '123456789';
            $data[0]['email'] = 'rossel@gmail.com';
            $data[0]['service'] = '100';
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
                // ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.teacher-list');
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')) {
            
        }
        return view('admin.teacher-edit');
    }

    public function update($id)
    {
        $validationSetting = array(
        // 'first_name' => ['required', 'string', 'max:255'],
        // 'last_name' => ['required', 'string', 'max:255'],
        // 'mobile_number' => ['required', 'string', 'max:255'],
        'phone_number' => ['string', 'max:255'],
        'date_of_birth' => ['date'],
        'gender' => ['string', 'max:255'],
        'address' => ['string', 'max:255'],
        'about_you' => ['string', 'max:255'],
        'fields_of_interest' => ['json'],
        'skills' => ['json'],
        'language' => ['json'],
        'qualification' => ['json'],
        'other' => ['string', 'max:255'],
        'avatar' => 'mimes:jpg,bmp,png',
        'resume' => 'mimes:pdf,docx,doc');

        if(!empty(request()->email)) {
            $emailValidation = array('email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users','email')->ignore($id),
            ]);
            $validationSetting = array_merge($validationSetting, $emailValidation);
        }
        $cleanData = request()->validate($validationSetting);

        if (request()->hasFile('avatar') && !empty(request()->file('avatar'))) {
            $oldFile = User::findOrFail($id)->avatar;
            $cleanData['avatar'] = fileUpload('avatar', $oldFile, $id);
        }

        if (request()->hasFile('resume') && !empty(request()->file('resume'))) {
            $oldFile = User::findOrFail($id)->resume;
            $cleanData['resume'] = fileUpload('resume', $oldFile, $id);
        }

        if(User::findOrFail($id)->update($cleanData)) {
            $row = User::findOrFail($id);
            if(!empty($row->avatar)) {
                $row->avatar = userFile($row->avatar, '', $id);
            }

            if(!empty($row->resume)) {
                $row->resume = userFile($row->resume, '', $id);
            }

            return response()->json([
                'success' => true,
                'data' => $row
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User can not be updated'
            ], 500);
        }
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