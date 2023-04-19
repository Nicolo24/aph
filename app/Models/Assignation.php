<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Assignation
 *
 * @property $id
 * @property $resource_id
 * @property $base_id
 * @property $user_id
 * @property $is_active
 * @property $created_at
 * @property $updated_at
 *
 * @property Base $base
 * @property Resource $resource
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Assignation extends Model
{
    
    static $rules = [
		'resource_id' => 'required',
		'base_id' => 'required',
		'user_id' => 'required',
		'is_active' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['resource_id','base_id','user_id','is_active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function base()
    {
        return $this->hasOne('App\Models\Base', 'id', 'base_id');
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

    

    
    

}
