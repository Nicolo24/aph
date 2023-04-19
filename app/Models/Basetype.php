<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Basetype
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Base[] $bases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Basetype extends Model
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
    public function bases()
    {
        return $this->hasMany('App\Models\Base', 'basetype_id', 'id');
    }
    

}
