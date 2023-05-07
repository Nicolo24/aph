<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reporttype
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $is_operative
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reporttype extends Model
{
    
    static $rules = [
		'name' => 'required',
		'is_operative' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','is_operative','icon'];



}
