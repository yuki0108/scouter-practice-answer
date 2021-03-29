<?php

namespace App\Http\Controllers\Auth;

use App\Department;
use App\Http\Controllers\Controller;
use App\Position;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'user_name_id' => ['required', 'string', 'max:20', 'unique:users'],
            'name' => ['required', 'string', 'max:255',],
            'zipcode' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'department_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i'],
        ]);
    }

    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register', [
            'departments' => Department::get(),
            'positions' => Position::get(),
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
        return User::create([
            'name' => $data['name'],
            'zipcode' => $data['zipcode'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'is_administrator' =>  $data['is_administrator'],
            'user_name_id' => $data['user_name_id'],
            'department_id' => $data['department_id'],
            'position_id' => $data['position_id']
        ]);
    }
}
