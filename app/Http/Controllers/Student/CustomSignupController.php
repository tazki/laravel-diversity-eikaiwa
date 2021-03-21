<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // need to add this line so this file is treated like a controller.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserPayments;

class CustomSignupController extends Controller
{
    public function addUser(Request $request)
    {
        $validationSetting = array(
            'agree' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'skype_id' => ['string', 'max:255']
        );
        $cleanData = request()->validate($validationSetting);
        $cleanData['status'] = 1;
        $cleanData['user_type'] = 'student';
        $cleanData['password'] = Hash::make($cleanData['password']);
        unset($cleanData['agree']);
        $user = User::create($cleanData);
        if(isset($user->id)) {
            switch(request()->service) {
                case 3:
                    $points = 8;
                    $price = 13310;
                break;
                case 2:
                    $points = 4;
                    $price = 7480;
                break;
                default:
                    $points = 1;
                    $price = 0;
                    $paymentData['status'] = 2;
                break;
            }

            $paymentData['user_id'] = $user->id;
            $paymentData['service_id'] = request()->service;
            $paymentData['service_price'] = $price;
            $paymentData['service_points'] = $points;
            UserPayments::create($paymentData);
            if(request()->service == 1) {
                // return back()->with('success','Student registered successfully!');
                return redirect(route('page_login'));
            } elseif(in_array(request()->service, array(2,3))) {
                return redirect(route('page_payment').'?id='.urlencode(base64_encode($user->id.'|'.request()->service)));
            }
        } else {
            return back()->with('success','Failed to register this time.');
        }
    }
}