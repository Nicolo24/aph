<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 *
 * @property $id
 * @property $center_id
 * @property $province_id
 * @property $zone_id
 * @property $institution_id
 * @property $basetype_id
 * @property $name
 * @property $latitude
 * @property $longitude
 * @property $comment
 * @property $is_active
 * @property $created_at
 * @property $updated_at
 *
 * @property Assignation[] $assignations
 * @property Basetype $basetype
 * @property Center $center
 * @property Institution $institution
 * @property Province $province
 * @property Zone $zone
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Base extends Model
{
    
    static $rules = [
		'center_id' => 'required',
		'province_id' => 'required',
		'zone_id' => 'required',
		'institution_id' => 'required',
		'basetype_id' => 'required',
		'name' => 'required',
		'latitude' => 'required',
		'longitude' => 'required',
		'is_active' => 'required',
    ];

    protected $perPage = 20;

    protected $table = 'bases';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['center_id','province_id','zone_id','institution_id','basetype_id','name','latitude','longitude','comment','is_active'];

    protected $appends = ['is_operative'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignations()
    {
        return $this->hasMany('App\Models\Assignation', 'base_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function basetype()
    {
        return $this->hasOne('App\Models\Basetype', 'id', 'basetype_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function center()
    {
        return $this->hasOne('App\Models\Center', 'id', 'center_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institution()
    {
        return $this->hasOne('App\Models\Institution', 'id', 'institution_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function province()
    {
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zone()
    {
        return $this->hasOne('App\Models\Zone', 'id', 'zone_id');
    }

    public function getAvailableResourcesAttribute(){
        return Resource::where('is_active', 1)->where('center_id', $this->center_id)->where('province_id', $this->province_id)->where('zone_id', $this->zone_id)->where('institution_id', $this->institution_id)->get()->filter(function($item){
            return $item->is_assigned == false;
        });

    }

    public function getAssignedResourcesAttribute(){
        return $this->assignations->where('is_active', 1);

    }

    public function getIsOperativeAttribute(){
        return $this->assignations->where('is_active', 1)->filter(function($item){
            return $item->resource->is_operative == true;
        })->count() > 0 ?? false;
    }

    public function getInEmergencyAttribute(){
        return $this->assignations->where('is_active', 1)->filter(function($item){
            return $item->resource->in_emergency == true;
        })->count() > 0 ?? false;
    }

    public function getIconAttribute(){
        return $this->getIsOperativeAttribute() ? "🟩" : "🟥";
    }
    

}
