<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Route
 *
 * @property $id
 * @property $resource_id
 * @property $user_id
 * @property $start_address
 * @property $start_latitude
 * @property $start_longitude
 * @property $emergency_address
 * @property $emergency_latitude
 * @property $emergency_longitude
 * @property $destination_address
 * @property $start_time
 * @property $pickup_time
 * @property $end_time
 * @property $destination_latitude
 * @property $destination_longitude
 * @property $instructions
 * @property $created_at
 * @property $updated_at
 *
 * @property Location[] $locations
 * @property Resource $resource
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Route extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['resource_id','user_id','start_address','start_latitude','start_longitude','emergency_address','emergency_latitude','emergency_longitude','destination_address','start_time','pickup_time','end_time','destination_latitude','destination_longitude','instructions'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('App\Models\Location', 'route_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resource()
    {
        return $this->hasOne('App\Models\Resource', 'id', 'resource_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getStatusAttribute()
    {
        if($this->start_time == null){
            return "Pendiente";
        }else if($this->pickup_time == null){
            return "Iniciada";
        }else if($this->end_time == null){
            return "Persona recogida";
        }else{
            return "Completada";
        }
    }
    

}
