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
                    return '<a href="'.route('students_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
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

    public function edit($id)
    {
        $row = User::where('id', $id)->first();
        if(is_object($row)) {
            $lang = array();
            $rows = UserDetails::where('user_id', $id)->get();
            if(is_object($rows) && sizeof($rows) > 0) {
                foreach($rows as $key => $val) {
                    $lang[$val->language_id]['address'] = $val->address;
                    $lang[$val->language_id]['about_you'] = $val->about_you;
                    $lang[$val->language_id]['hobbies'] = $val->hobbies;
                    $lang[$val->language_id]['fields_of_interest'] = $val->fields_of_interest;
                    $lang[$val->language_id]['english_level'] = $val->english_level;
                }
            }
        }

        if(request()->isMethod('post')) {
            $validationSetting = array(
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'phone_number' => ['string', 'max:255'],
                'skype_id' => ['string', 'max:255'],
                'avatar' => 'mimes:jpg,bmp,png'
            );
            
            if(!empty(request()->email)) {
                $emailValidation = array('email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users','email')->ignore($id),
                ]);
                $validationSetting = array_merge($validationSetting, $emailValidation);
            }

            if(!empty(request()->password)) {
                $passwordValidation = array('password' => ['required', 'string', 'min:8', 'confirmed']);
                $validationSetting = array_merge($validationSetting, $passwordValidation);
            }
            $cleanData = request()->validate($validationSetting);

            if(!empty(request()->password)) {
                $cleanData['password'] = Hash::make($cleanData['password']);
            } else {
                unset($cleanData['password']);
            }
            $condition['id'] = $id;
            if(User::updateOrCreate($condition, $cleanData)) {
                if(request()->hasFile('avatar') && !empty(request()->file('avatar'))) {
                    $oldFile = User::findOrFail($id)->avatar;
                    $cleanData['avatar'] = fileUpload('avatar', $oldFile, $id);
                    $condition['id'] = $id;
                    User::updateOrCreate($condition, $cleanData);
                }

                if(isset(request()->lang) && is_array(request()->lang)) {
                    foreach(request()->lang as $language_id => $lang) {
                        UserDetails::where([
                            ['user_id', '=', $id],
                            ['language_id', '=', $language_id]
                        ])->update($lang);
                    }
                }

                return back()->with('success','Data updated successfully!');
            } else {
                return back()->with('success','Teacher can not be updated');
            }
        }
        return view('admin.student-edit', compact('row'));
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