<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = 'customer-login';

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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
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
        $user = User::where('email', $data['email'])->first();
        if (is_null($user)) {

            $normalRole        = Role::where('name', 'normal')->first();
            $user              = new User;
            $user->name        = $data['first_name'] . ' ' . $data['last_name'];
            $user->email       = $data['email'];
            $user->password    = bcrypt($data['password']);
            $user->email_token = str_random(10);
            $user->phone =       $data['phone'];
            $user->address = $data['address'];
            $user->save();
            $user->roles()->attach($normalRole);
            Mail::to($user)->send(new VerifyEmail($user));

            request()->session()->flash('success_message', 'You are registered. Please verify your email to login.');

            return $user;
        } else {
            return back()->with('failure_message', 'The email already exists!');
        }
    }


    // Get the user who has the same token and change his/her status to verified i.e. 1
    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('email_token', $token)->firstOrFail()->email_verified();

        return redirect('/customer-login')->with('success_message', 'Your email is verified. You can now login.');
    }

    // $this->guard()->login($user);//disballing forced login
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));



        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
