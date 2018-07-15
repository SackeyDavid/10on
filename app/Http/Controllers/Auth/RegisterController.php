<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

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
    protected $redirectTo = '/home';

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
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contact_person' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'agree' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
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
        $membership_number = 'TN' . sprintf('%08d', mt_rand(10000000,99999999));

         $user = User::create([
            'title' => $data['title'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'contact_person' => $data['contact_person'],
            'country' => $data['country'],
            'mobile_number' => $data['mobile_number'],
            'remind_me' => 'yes',
            'agree' => $data['agree'],
            'membership_number' => $membership_number,
            'password' => bcrypt($data['password']),
        ]);

        $name = $data['title'] . ' ' . $data['first_name'] . ' ' . $data['last_name'];
        $email = $data['email'];

        $data = array('email'=> $email, 'name' => $name, 'from' => 'davidkofiahensackey@gmail.com', 'from_name' => '10ondrives.com');

        Mail::send('mail.user-welcome-email', ['name' => $name, 'user' => $user, 'membership_number' => $membership_number ], function($message) use ($data)
        {

            $message->to($data['email'], $data['name'])->subject('10ondrives.com :: Your Account Information');
            $message->from($data['from'], $data['from_name']);
        });

        return $user;
        // return redirect()->route('payment.details.register');
    }


}
