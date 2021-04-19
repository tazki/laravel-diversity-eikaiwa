<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
use DataTables;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserPayments;
use App\Models\ContactForms;

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
                ->addColumn('status', function($row) {
                    $checked = ($row->status==1) ? 'checked="checked"' : '';
                    return '<div class="switch-wrapper">
                        <!--div class="d-inline-block mr-2">Inactive</div-->
                        <label class="js-status-switcher-control switcher-control">
                            <input type="checkbox" class="switcher-input" value="'.$row->status.'" '.$checked.' onClick="window.ajaxSingle(this)" data-update="'.url('admin/users/'.$row->id.'/status').'" data-disable="switcher-input">
                            <span class="switcher-indicator"></span>
                        </label>
                        <!--div class="d-inline-block ml-2">Active</div-->
                    </div>';
                })
                ->addColumn('action', function($row) {
                    return '<a href="'.route('students_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
                    // $btn = '<a href="'.route('teachers_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
                    // $btn .= '<a class="js-btn-delete btn btn-sm btn-icon btn-secondary " data-toggle="modal" data-target="#deleteModal" data-deleteurl="" href="#"><i class="far fa-trash-alt"></i></a>';
                    // return $btn;
                })
                ->rawColumns(['status','action'])
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

        $rowPayment = UserPayments::where('user_id', '=', $id)
            ->orderBy('id', 'desc')
            ->get();
        if(isset($rowPayment[0]) && isset($rowPayment[0]->service_id)) {
            $service = currentService($rowPayment[0]->service_id);
            switch($rowPayment[0]->status) {
                case 2:
                    $service['payment']['status'] = __('Completed');
                break;
                case 1:
                    $service['payment']['status'] = __('Cancelled');
                break;
                default:
                    $service['payment']['status'] = __('Pending');
                break;
            }
        }
        $service['activePoints'] = studentActivePoints($id);
        $service['has_upgrade_request'] = ContactForms::where('student_id', '=', $id)->first();

        if(request()->isMethod('post')) {
            $validationSetting = array(
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'phone_number' => ['string', 'max:255'],
                'skype_id' => ['string', 'max:255'],
                'avatar' => 'mimes:jpg,bmp,png',
                'address' => ['required', 'string', 'max:255'],
                'postal_code' => ['required', 'string', 'max:255'],
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
                        $condition = array();
                        $condition['user_id'] = $id;
                        $condition['language_id'] = $language_id;
                        UserDetails::updateOrCreate($condition, $lang);
                    }
                }

                return back()->with('success','Data updated successfully!');
            } else {
                return back()->with('success','Student can not be updated');
            }
        }
        return view('admin.student-edit', compact('row', 'lang', 'service'));
    }

    public function studentUpgradePlan(Request $request)
    {
        $rowPayment = UserPayments::where('user_id', '=', $request->user_id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
        if(isset($rowPayment[0]) && isset($rowPayment[0]->service_id)) {
            $paymentData['status'] = 2;
            $condition['id'] = $rowPayment[0]->id;
            UserPayments::updateOrCreate($condition, $paymentData);

            ContactForms::find($request->contact_id)->delete();
        }
        return back()->with('success','Plan Upgrade successfully!');
    }
}