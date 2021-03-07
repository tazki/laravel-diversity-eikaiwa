<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomSignupController extends Controller
{
    public function addUser(Request $request)
    {
        $validationSetting = array(
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'skype_id' => ['string', 'max:255']
        );
        $cleanData = request()->validate($validationSetting);

        if(request()->service == 1) {
            $cleanData['status'] = 1;
            $cleanData['user_type'] = 'student';
            $cleanData['password'] = Hash::make($cleanData['password']);
            $user = User::create($cleanData);
            if(isset($user->id)) {
                // return back()->with('success','Student registered successfully!');
                return redirect(route('page_login'));
            } else {
                return back()->with('success','Failed to register this time.');
            }
        } elseif(request()->service == 2) {

        }
        
    }
}