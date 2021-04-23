<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserPayments;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where([
                    ['users.user_type', '=', 'student'],
                    ['user_payments.status', '=', 2]
                ])
                ->leftJoin('user_payments', function($query) {
                    $query->on('user_payments.user_id', '=', 'users.id')
                    ->whereRaw('mt_user_payments.id IN (select MAX(a2.id) from mt_user_payments as a2 join mt_users as u2 on u2.id = a2.user_id group by u2.id)');
                })
                ->orderBy('user_payments.updated_at', 'desc')
                ->get();
            // $data = User::where([
            //         ['users.user_type', '=', 'student'],
            //         // ['user_payments.status', '=', 2]
            //     ])
            //     ->where(function ($query) {
            //         $query->select(
            //                 'user_payments.updated_at',
            //                 'user_payments.service_id',
            //                 'user_payments.user_id'
            //             )
            //             ->from('user_payments')
            //             ->whereColumn('user_payments.user_id', 'users.id')
            //             ->where('user_payments.status', '=', 2)
            //             ->orderByDesc('user_payments.updated_at')
            //             ->limit(1);
            //     })
            //     ->select(DB::raw('CONCAT(first_name, " ", last_name) as name'),
            //         // 'user_payments.updated_at',
            //         // 'user_payments.service_id',
            //         // 'user_payments.user_id',
            //         'users.id'
            //     )
            //     // ->leftJoin('subscriptions', 'subscriptions.user_id', '=', 'users.id')
            //     // ->leftJoin('user_payments', 'user_payments.user_id', '=', 'users.id')
            //     // ->orderBy('user_payments.updated_at', 'desc')
            //     // ->distinct('users.id')
            //     ->get();

            // if no return data
            if(empty(sizeof($data))) {
                $data['data'] = array();
                return $data;
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('first_name', function($row) {
                    if(!empty($row->service_id)) {
                        return '<a href="'.route('students_edit', ['id' => $row->user_id]).'">'.$row->first_name.' '.$row->last_name.'</a>';
                    } else {
                        return $row->first_name.' '.$row->last_name;
                    }
                })
                ->addColumn('service', function($row) {
                    if(!empty($row->service_id)) {
                        $service = currentService($row->service_id);
                        return $service['payment']['service'];
                    }
                })
                ->addColumn('price', function($row) {
                    if(!empty($row->service_id)) {
                        $service = currentService($row->service_id);
                        return $service['payment']['price_label'];
                    }
                })
                ->rawColumns(['first_name','service'])
                // ->addColumn('action', function($row) {
                //     $btn = '<a href="'.route('teachers_edit', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'"><i class="fa fa-pencil-alt"></i></a>';
                //     // $btn .= '<a class="js-btn-delete btn btn-sm btn-icon btn-secondary " data-toggle="modal" data-target="#deleteModal" data-deleteurl="" href="#"><i class="far fa-trash-alt"></i></a>';
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.payment');
    }
}