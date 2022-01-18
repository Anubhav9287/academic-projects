<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    // protected $redirectTo = '/profile/{{auth()->user()->id}}';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirectTo(){
        
        // User role
        $role = auth()->user()->id;
        return '/profile/'.$role;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'contactnumber' => ['required', 'digits:10'],
            'r_name' => ['required', 'string', 'max:255'],
            'r_contactnumber' => ['required', 'digits:10'],
            'signup' => ['required'],
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
        if (!array_key_exists("building_no", $data)) {
            $data['building_no'] = null;
        }
        if (!array_key_exists("floor_no", $data)) {
            $data['floor_no'] = null;
        }
        if (!array_key_exists("apartment_no", $data)) {
            $data['apartment_no'] = null;
        }
        if (!array_key_exists("status", $data)) {
            $data['status'] = 'inactive';
        }

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'address' => $data['address'],
            'contactnumber' => $data['contactnumber'],
            'r_name' => $data['r_name'],
            'r_contactnumber' => $data['r_contactnumber'],
            'signup' => $data['signup'],
            'subdivision_name' => $data['subdivision_name'],
            'building_no' => $data['building_no'],
            'floor_no' => $data['floor_no'],
            'apartment_no' => $data['apartment_no'],
            'status' => $data['status'],
            'password' => Hash::make($data['password']),
        ]);

        $service = new Service();
        $service->Gas;
        $service->Water;
        $service->Electricity;
        $service->Internet;
        $service->user_id=$user->id;
        $service->save();

        return $user;
    }
}
