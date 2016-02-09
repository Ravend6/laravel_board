<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'surname',
        'email',
        'password',
        'email_confirm',
        'activation_token',
        'birthday',
        'phone',
        'status',
        'gender',
        'lang',
        'avatar',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // public function roles()
    // {
    //     return $this->hasMany('App\Role');
    // }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function executant()
    {
        return $this->hasOne('App\Executant');
    }

    public function albums()
    {
        return $this->hasMany('App\Album');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task', 'user_customer_id');
    }

    public function propositions()
    {
        return $this->hasMany('App\Proposition', 'user_executant_id');
    }

    public function studies()
    {
        return $this->hasMany('App\Study');
    }

    public function experiences()
    {
        return $this->hasMany('App\Experience');
    }

    public function owns($related)
    {
        return $this->id == $related->user_id;
    }
}
