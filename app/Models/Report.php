<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 *
 * @property $id
 * @property $resource_id
 * @property $user_id
 * @property $reporttype_id
 * @property $comment
 * @property $created_at
 * @property $updated_at
 *
 * @property Reporttype $reporttype
 * @property Resource $resource
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Report extends Model
{
    
    static $rules = [
		'resource_id' => 'required',
		'user_id' => 'required',
		'reporttype_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['resource_id','user_id','reporttype_id','comment'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reporttype()
    {
        return $this->hasOne('App\Models\Reporttype', 'id', 'reporttype_id');
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
