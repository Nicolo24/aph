<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resourcetype
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Resource[] $resources
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Resourcetype extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources()
    {
        return $this->hasMany('App\Models\Resource', 'resourcetype_id', 'id');
    }
    

}
