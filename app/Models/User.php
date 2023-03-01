<?php

namespace App\Models;

use App\Mail\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;



class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles, HasFactory, HasPermissions ,SoftDeletes;

    protected $pere_page = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile',  'password', 'api_token' , 'avatar' , 'organization_id'
    ];

    protected $with = ['roles'];

    public static $staff_roles = [
        'admin'
    ];

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
        'email_verified_at' => 'datetime:Y-m-d | H:i a',
        'created_at' => 'datetime:Y-m-d | H:i a',
    ];


    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function resetPassword()
    {
        $this->update(['api_token' => substr(md5(Str::random() . $this->email . time()), 0, 32)]);
        try {
            Mail::to($this->email)->send(new PasswordReset($this));
        } catch (\Throwable $th) {
        }

        return response('success');
    }


    public function isStaffMember()
    {
        return $this->hasRole(self::$staff_roles);
    }

    public function getAvatarAttribute($value)
    {
        return config('app.url') . ($value ? "/storage/$value" : '/assets/images/avatar-placeholder.jpg');
    }
}
