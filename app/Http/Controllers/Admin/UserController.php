<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use App\Mail\VerifyEmail;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{

    protected $image_prefix = 'user';

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'user';
        $this->data['roles']=Role::get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = User::latest()->paginate($this->default_pagination_limit);

        $this->data['current_user_id']=auth()->user()->id;
        return view('admin.user.view',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.user.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user             = new User();
        $default_role     = Role::where('name', 'normal')->first();
        $user->name       = $request->name;
        $user->email      = $request->email;
        $randomPassword=randomPassword();
        $user->password   = bcrypt($randomPassword);
        $user->address    = $request->address;
        $user->about      = $request->about;
        $user->phone      = $request->phone;
        $user->verified   = 1;
        $user->auth_token = str_random(250);
        // $roles            = ($request->role !== null) ? $request->role : $default_role;


        if ( ! is_null($request->image)) {
            $image_path_from_public='users';
            $image_name  = upload_image($request->image, $this->image_prefix,$image_path_from_public);
            $user->image = $image_name;
            $this->fitImage(256,256,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
        }

        if ($user->save()) {
            $user->roles()->attach(3);

            // send credentials to new created vendors
            // Mail::to($user->email)->send(new VerifyEmail($user));
            $user_data=[
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>$randomPassword,

            ];
            $this->sendCredentials($user_data);

            return $request->ajax()
                ? "You have successfully signed up. Please check your email to verify it."
                : back()->with('success_message', 'User successfully created');
        } else {
            return $request->ajax()
                ? "Sorry, sign up process could not be successful. Please try again later."
                : back()->with('failure_message', 'Sorry, user could not be created. Please try again later');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $authenticated_user = auth()->user();
        if ( ! $authenticated_user->hasRole('admin') && ! ($authenticated_user->id == $user->id)) {
            return back()->with('failure_message', 'Access Denied');
        }
        $this->data['edit']=true;

        $this->data['model']  = $user;


        return view('admin.user.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $authenticated_user = auth()->user();
        if ( ! $authenticated_user->hasRole('admin') && ! ($authenticated_user->id == $user->id)) {
            return back()->with('failure_message', 'Access Denied');
        }
        $default_role  = Role::where('name', 'normal')->first();
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->address = $request->address;
        $user->phone   = $request->phone;

        $user->about   = $request->about;


        // if image is present, delete previous image and assign name of newly uploaded image to model.
        if ( ! is_null($request->image)) {
            $image_path_from_public='users';
            $user->delete_image('image','users');
            $user->image = $image_name= upload_image($request->image, $this->image_prefix,$image_path_from_public);
             $this->fitImage(256,256,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
        }

        if ($user->save()) {
            if (auth()->user()->hasRole('admin')) {
                $authenticated_user->id==$user->id?  $user->roles()->sync(1): $user->roles()->sync(3);


            }else
            {
                 $user->roles()->sync(3);

            }

            return back()->with('success_message', 'User Successfully updated');
        } else {
            return back()->with('failure_message', 'Sorry, it could not be updated. Please try again later');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $authenticated_user = auth()->user();
        if ( ! $authenticated_user->hasRole('admin') && ! ($authenticated_user->id == $user->id)) {
            return back()->with('failure_message', 'Access Denied');
        }

        if (auth()->id() == $user->id) {
            return back()->with('failure_message', 'Sorry, you cannot delete yourself.');
        }

        if ($user->delete()) {

            $user->delete_image('image','users');

            return back()->with('success_message', 'User successfully deleted.');
        }

        return back()->with('failure_message', 'User could not be deleted. Please try again later.');
    }

    public function profile() {
        $this->data['user'] = auth()->user();

        return view('admin.user.profile', $this->data);
    }


    public function change_password_form() {
        return view('admin.user.change_password', $this->data);
    }


    public function change_password(Request $request) {
        $request->validate([
            'old_password'              => 'bail|required|string|min:5',
            'new_password'              => 'bail|required|string|min:5|same:new_password_confirmation',
            'new_password_confirmation' => 'bail|required|string|min:5',
        ]);

        $user = auth()->user();
        if (Hash::check($request->old_password, $user->password)) {

            $user->password = bcrypt($request->new_password);
            if ($user->save()) {
                return redirect()->back()->with('success_message', 'Your password has been changed successfully');
            } else {
                return redirect()->back()->with('failure_message', 'Sorry, your password could not be changed. Please try again later.');
            }
        }

        return redirect()->back()->with('failure_message', 'Your old password did not match. Please try again.');
    }


    public function sendCredentials($emailData)
     {

        Mail::send('emails.vendor_credentials', ['data'=>$emailData], function ($message) use($emailData)
           {

               $message->from(env('APP_EMAIL'), config('app.name'));
               $message->subject('User Credentials');

               $message->to($emailData['email']);

           });
    }


    public function changeApprovedStatus($id)
    {
       $user=User::find($id);
       if($user->isApproved)
       {
        $user->update(['isApproved'=>0]);

       }else
       {
        $password=randomPassword();
        $user->update(['isApproved'=>1,'password'=>bcrypt($password)]);
        $data=['name'=>$user->name,'email'=>$user->email,'password'=>$password];
        Mail::send('emails.whole_seller_approved', ['data'=>$data], function ($message) use($data)
           {

               $message->from(env('APP_EMAIL'), config('app.name'));
               $message->subject('User Credentials');

               $message->to($data['email']);

        });

       }
       return response()->json(['status'=>true]);

    }

}
