<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;
use Auth;
use DB;
use App\Models\UserReviews;
use App\Models\UserBookings;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('user_bookings')
                ->select(
                    'user_bookings.*',
                    'user_reviews.review_rating',
                    DB::raw('mt_user_reviews.id as review_id'),
                    DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%Y-%m-%d") as ymd_booking_date'),
                    DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%M %d, %Y %H:%i") as label_booking_date'),
                    DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as teacher_name'),
                )
                ->leftJoin('users', 'users.id', '=', 'user_bookings.teacher_id')
                ->leftJoin('user_reviews', 'user_reviews.booking_id', '=', 'user_bookings.id')
                ->where('user_bookings.student_id', Auth::user()->id)
                ->where('user_bookings.status', 3)
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
                        if($row->review_rating >= $i) {
                            $stars .= '<i class="fa fa-star text-yellow"></i>';
                        } else {
                            $stars .= '<i class="far fa-star text-yellow"></i>';
                        } 
                    }

                    return '<div class="my-1">'.$stars.'</div>';
                })
                ->addColumn('action', function($row) {
                    $icon = '<i class="fa fa-plus"></i>';
                    if(!empty($row->review_rating)) {
                        $icon = '<i class="fa fa-pencil-alt"></i>';
                    }
                    $btn = '<a href="'.route('student_review_add', ['id' => $row->id]).'" class="btn btn-sm btn-icon btn-secondary" title="'.__('Edit').'">'.$icon.'</a>';
                    return $btn;
                })
                ->rawColumns(['review','action'])
                ->make(true);
        }

        return view('student.review');
    }

    public function add($id)
    {
        $row = UserBookings::where('user_bookings.id', '=', $id)
            ->select(
                'user_bookings.*',
                'user_reviews.review_title',
                'user_reviews.review_content',
                'user_reviews.review_rating',
                DB::raw('mt_user_reviews.id as review_id'),
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%Y-%m-%d") as ymd_booking_date'),
                DB::raw('DATE_FORMAT(mt_user_bookings.booking_date, "%M %d, %Y %H:%i") as label_booking_date'),
                DB::raw('CONCAT(mt_users.first_name, " ", mt_users.last_name) as teacher_name')
            )
            ->leftJoin('users', 'users.id', '=', 'user_bookings.teacher_id')
            ->leftJoin('user_reviews', 'user_reviews.booking_id', '=', 'user_bookings.id')
            ->first();
        return view('student.review', compact('row'));
    }

    public function store(Request $request)
    {
        if($request->isMethod('post')) {
            $validationSetting = array(
                'review_title' => ['required', 'string', 'max:255'],
                'review_content' => ['string', 'max:255'],
                'review_rating' => ['required', 'integer']
            );
            $cleanData = request()->validate($validationSetting);
            $cleanData['teacher_id'] = $request->teacher_id;
            $cleanData['student_id'] = $request->student_id;
            $cleanData['booking_id'] = $request->booking_id;
            $row = UserReviews::create($cleanData);
            if(isset($row->id)) {
                return redirect(route('student_review'))->with('success','Data created successfully!');
            } else {
                return back()->with('success','Review can not be created');
            }
        }
    }

    public function update($id)
    {
        $validationSetting = array(
            'review_title' => ['required', 'string', 'max:255'],
            'review_content' => ['string', 'max:255'],
            'review_rating' => ['required', 'integer']
        );
        $cleanData = request()->validate($validationSetting);
        $condition['id'] = $id;
        if($row = UserReviews::updateOrCreate($condition, $cleanData)) {
            return redirect(route('student_review_add', ['id' => $row->id]))->with('success','Data updated successfully!');
        }
    }
}