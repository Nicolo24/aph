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

    static $rules = [
        'name',
        'email',
        'center_id',
        'province_id',
        'zone_id',
        'institution_id',
        'usertype_id',
    ];

    protected $perPage = 20;

    protected $fillable = [
        'name',
        'email',
        'password',
        'center_id',
        'province_id',
        'zone_id',
        'institution_id',
        'resource_id',
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

    function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    function getBasesAttribute()
    {
        if ($this->usertype->name == "Analista de despacho") {
            return \App\Models\Base::where([
                ["institution_id", "=", $this->institution_id],
                ["zone_id", "=", $this->zone_id],
                ["province_id", "=", $this->province_id],
                ["center_id", "=", $this->center_id],
            ])->get();
        }
    }

    function getResourcesAttribute()
    {
        if ($this->usertype->name == "Analista de despacho") {
            return \App\Models\Resource::where([
                ["institution_id", "=", $this->institution_id],
                ["zone_id", "=", $this->zone_id],
                ["province_id", "=", $this->province_id],
                ["center_id", "=", $this->center_id],
            ])->get();
        }
    }

    // get available routes, return route where resource_id = user->resource_id and route->user_id = null
    function getAvailableRoutesAttribute()
    {
        $resource = $this->resource;
        //if resource is not null
        if ($resource) {
            return \App\Models\Route::where("resource_id", $resource->id)->whereNull('user_id')->get();
        } else {
            return [];
        }

    }
}