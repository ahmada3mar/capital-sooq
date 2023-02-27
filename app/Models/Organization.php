<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'domain',
        'primary_domain',
        'address',
        'longitude',
        'latitude',
        'logo',
        'currency',
        'industry_id',
        'expired_at',
        'plan_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
        'expired_at' => 'datetime'
    ];


    public static function primaryDomain($name , $increment = \null)
    {
        $domain = Str::slug($name) . $increment . '.' . config('app.domain' , 'capitalsooq.com');
        info($domain);
        if(Organization::wherePrimaryDomain($domain)->exists()){
            $increment++;
            return self::primaryDomain($name , $increment);
        }
        return $domain;
    }

    public function getExpiredAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getLogoAttribute($value)
    {
        return config('app.url') . ($value ? "/storage/$value" : '/assets/images/no-logo.png');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
