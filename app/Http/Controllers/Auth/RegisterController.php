<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Organization;
use App\OrganizationPayment;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $organization = Organization::create([
            'company_name' => $data['company_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_number' => $data['mobile_number'],
            'building' => $data['building'],
            'street' => $data['street'],
            'address' => $data['address'],
            'city' => $data['city'],
            'province' => $data['province'],
            'zipcode' => $data['zipcode'],
            'country_id' => $data['country_id'],
            'registration_number' => $data['registration_number'],
            'gist_number' => $data['gist_number'],
            'status' => 1
        ]);

        OrganizationPayment::create([
            'organization_id' => $organization->id,
            'service' => 1,//$data['service'],
            'status' => 1
        ]);

        $user = User::create([
            'organization_id' => $organization->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => 'organization',
            'status' => 1
        ]);

        // $this->email = $user['email'];
        // Mail::to($data['email'])->send(new WelcomeMail($user));
        // $this->notify(new WelcomeEmail($user));
        return $user;
    }
}
