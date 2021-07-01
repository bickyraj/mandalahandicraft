<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\UserPasswordResetNotification;
use App\Traits\CommonModel;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,CommonModel;
    protected $guarded=['id'];
    protected $dates=['dob'];


    public function image()
    {
        return $this->image!==null?asset($this->upload_path.'users/modified/'.$this->image):asset('default.png');
    }

    
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function getNameAttribute($value) {
        return ucwords($value);
    }

    public function email_verified() {
        $this->verified    = 1;
        $this->email_token = null;
        $this->save();
    }

    public function verified() {
        return $this->verified ? "Yes" : "No";
    }

    public function isVerified()
    {
        return $this->verified == 1;
    }

    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role_name) {
        foreach ($this->roles as $role) {
            if ($role->name == $role_name) {
                return true;
            }
        }

        return false;
    }

    public function has_role($role_id) {
        foreach ($this->roles as $role) {
            if ($role->id == $role_id) {
                return true;
            }
        }

        return false;
    }

    public function hasOnlyRole($role_name) {
        return (count($this->roles) === 1 && $this->roles()->first()->name == $role_name);
    }


    public function products() {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }



    public function isMyProduct($product_id)
    {
        foreach($this->products as $p)
        {
            if($p->id==$product_id)
            {
                return $p->id;
            }


        }
        return 0;

    }


    public function wishlists()
    {
        return $this->belongsToMany(Product::class,'wishlists','user_id','product_id');
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordResetNotification($token));
    }


}
