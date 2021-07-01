<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin';

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = $request->user();

            if ($request->has('user') && ($user->hasRole('admin') || $user->hasRole('vendor'))) {
                auth()->logout();
                $request->session()->flush();

                return redirect()->back()->with('failure_message', 'You are not authorize user to login from here!');

            }

            if ($user->hasRole('wseller') && !$user->isApproved) {

                auth()->logout();
                return redirect()->back()->with('failure_message', 'Your account is not approved by site admin,please wait for admin approval!');

            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function redirectTo()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') || $user->hasRole('vendor')) {

            return '/admin';
        } elseif ($user->hasRole('normal') || $user->hasRole('wseller')) {
            // session(['success_message'=>'Login Successfull!']);
            request()->session()->flash('success_message', 'You are successfully loggedin.');
            return '/';
        }

    }

    // public function authenticated($request , $user){
    //     if($user->hasRole('admin') || $user->hasRole('vendor')){
    //         return redirect()->route('admin_home') ;
    //     }elseif($user->hasRole('normal')){
    //         return redirect()->route('home') ;
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // allow login to only verified users
    public function credentials(Request $request)
    {

        return [
            'email' => $request->email,
            'password' => $request->password,
            'verified' => 1,
            'status' => 1,
            'email_token' => null,
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($user = User::where('email', $request->email)->first()) {

            /*checking if password is match or not*/
            if (!(Hash::check($request->password, $user->password))) {

                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        'incorrect_password' => Lang::get('auth.incorrect_password'),
                    ]);

            } else if (!$user->verified) {
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        'verified' => Lang::get('auth.verified'),
                    ]);
            }

        }

        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);

    }

    public function logout(Request $request)
    {
        $is_admin = auth()->user()->hasRole('admin');
        $is_vendor = auth()->user()->hasRole('vendor');

        if (auth()->check()) { // if a user is logged in
            $this->guard()->logout();
            // $request->session()->flush();
            $request->session()->regenerate();

            if ($is_admin || $is_vendor) {
                return redirect()->route('admin_home');
            } else {
                return redirect()->route('home')->with('success_message', 'You are logged out!');
            }
        }

        // return redirect()->intended(route('admin_home'));

        // if a user in not logged in, return false. i.e. do nothing
        return false;
    }

}
