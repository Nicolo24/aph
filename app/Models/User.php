<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'center_id',
        'province_id',
        'zone_id',
        'institution_id',
        'usertype_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function center()
    {
        return $this->belongsTo(Center::class);
    }

    function province()
    {
        return $this->belongsTo(Province::class);
    }

    function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    function usertype()
    {
        return $this->belongsTo(Usertype::class);
    }
    
}
