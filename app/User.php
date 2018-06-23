<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify( new ResetPasswordNotification( $token ) );
    }

    /**
     * Get all the roles this user belongs to
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if the user has authorized role/s
     *
     * @param  string|array $roles
     *
     * @return boolean | \Illuminate\Http\Response
     */
    public function authorizeRoles($roles)
    {
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
     * Check user role/s
     *
     * @param  string|array  $role
     *
     * @return boolean
     */
    public function hasRole($roles)
    {
        if ( is_array( $roles ) ) {
            return null !== $this->roles()->whereIn('name', $roles)->first();
        }

        return null !== $this->roles()->where('name', $role)->first();
    }

}
