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
use App\Models\ContactForms;

class ContactFormController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactForms::select('*', 
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
                ->addColumn('name', function($row) {
                    if(!empty($row->service_id)) {
                        return '<a href="'.route('students_edit', ['id' => $row->student_id]).'">'.$row->name.'</a>';
                    } else {
                        return $row->name;
                    }
                })
                ->addColumn('service', function($row) {
                    if(!empty($row->service_id)) {
                        $service = currentService($row->service_id);
                        return $service['payment']['service'];
                    }
                })
                ->rawColumns(['name','service'])
                // ->addColumn('action', function($row) {
                //     $btn = '<a href="'.route('teachers_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
                //     // $btn .= '<a class="js-btn-delete btn btn-sm btn-icon btn-secondary " data-toggle="modal" data-target="#deleteModal" data-deleteurl="" href="#"><i class="far fa-trash-alt"></i></a>';
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.contact-form');
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