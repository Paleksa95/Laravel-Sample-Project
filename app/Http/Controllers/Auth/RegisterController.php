<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyEmail;


class RegisterController extends Controller {
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
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken' => Str::random(40),
        ]);

        //Sending e mail to user so he can verify his account.
        $this->sendEmail($user);


        //Attaching default "user" role to fresh user.
        $user->roles()->attach(3);

    }


    /**
     * Sending mail to user thet is currently registered.
     *
     * @param $user
     *
     */

    public function sendEmail($user) {
        Mail::to($user['email'])->send(new verifyEmail($user));
    }



    public function verifyEmail() {
        return view('verify.verify');
    }

/*
 * When user visit link from e-mail addres he provided this function is used to activate his account.
 *
 */
    public function verifyToken($token) {
        $user = User::where('verifyToken', $token)->first();

      if($user){
           User::where('verifyToken', $token)->update([
                                                        'is_active' => 1,
                                                        'verifyToken' => NULL
                                                     ]);

          return redirect()->route('login')->with('verify', 'Your account is activated , you can now log in.');
      }
            return 'User is already active or does not exist!';
    }



}
