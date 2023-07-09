<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource
 *
 * @property $id
 * @property $center_id
 * @property $province_id
 * @property $zone_id
 * @property $institution_id
 * @property $resourcetype_id
 * @property $name
 * @property $comment
 * @property $is_active
 * @property $created_at
 * @property $updated_at
 *
 * @property Assignation[] $assignations
 * @property Center $center
 * @property Institution $institution
 * @property Province $province
 * @property Report[] $reports
 * @property Resourcetype $resourcetype
 * @property Zone $zone
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Resource extends Model
{

    static $rules = [
        'center_id' => 'required',
        'province_id' => 'required',
        'zone_id' => 'required',
        'institution_id' => 'required',
        'resourcetype_id' => 'required',
        'name' => 'required',
        'is_active' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['center_id', 'province_id', 'zone_id', 'institution_id', 'resourcetype_id', 'name', 'comment', 'is_active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignations()
    {
        return $this->hasMany('App\Models\Assignation', 'resource_id', 'id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'resource_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resourcetype()
    {
        return $this->hasOne('App\Models\Resourcetype', 'id', 'resourcetype_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'resource_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zone()
    {
        return $this->hasOne('App\Models\Zone', 'id', 'zone_id');
    }

    public function getIsAssignedAttribute()
    {
        return $this->assignations()->where('is_active', true)->count() > 0;
    }

    public function getLastReportAttribute()
    {
        return $this->reports()->orderByDesc('created_at')->first() ?? false;
    }

    public function getLastAssignationAttribute()
    {
        return $this->assignations()->where('is_active', true)->with(['base', 'user'])->orderByDesc('created_at')->first() ?? false;
    }

    public function getReporttypeIdAttribute()
    {
        return $this->reports()->orderByDesc('created_at')->first()->reporttype->id ?? false;
    }

    public function getIsOperativeAttribute()
    {
        return $this->reports()->orderByDesc('created_at')->first()->reporttype->is_operative ?? false;
    }

    public function getInEmergencyAttribute()
    {
        return $this->reports()->orderByDesc('created_at')->first()->reporttype->in_emergency ?? false;
    }

    public function getIsAvailableAttribute()
    {
        //where getIsOperativeAttribute is true and getInEmergencyAttribute is false and getIsAssignedAttribute is true
        return $this->getIsOperativeAttribute() && !$this->getInEmergencyAttribute() && $this->getIsAssignedAttribute();
    }

    public function getIconAttribute()
    {
        return $this->getLastReportAttribute() ? $this->getLastReportAttribute()->reporttype->icon : "<i class='fas fa-question'></i>";
    }

    public function getWasReportedAttribute($when)
    {
        return $this->reports()->where('created_at', '<=', $when)->latest()->first() ?? false;
    }

    public function getWasOperativeAttribute($when)
    {
        return $this->getWasReportedAttribute($when)->reporttype->is_operative ?? false;
    }

    public function getWasOperativeIconAttribute($when)
    {
        return $this->getWasOperativeAttribute($when) ? "🟩" : "🟥";
    }

    public function getTimeStatsAttribute($start = null, $end = null)
    {
        $reports = $this->reports()->get();
        $time = $reports->first()->created_at->diffInSeconds(now());

        $total_operative = 0;
        $total_not_operative = 0;
        $total_emergency = 0;
        $prev_report = $reports->first();
        $last_report = $reports->last();

        foreach ($reports as $report) {
            $current_report = $report->created_at;
            $prev_report_type = $prev_report->reporttype;

            if ($prev_report_type->is_operative) {
                $total_operative += $current_report->diffInSeconds($prev_report->created_at);
            } else {
                $total_not_operative += $current_report->diffInSeconds($prev_report->created_at);
            }

            if ($prev_report_type->in_emergency) {
                $total_emergency += $current_report->diffInSeconds($prev_report->created_at);
            }

            if ($report === $last_report) {
                if ($report->reporttype->is_operative) {
                    $total_operative += now()->diffInSeconds($current_report);
                } else {
                    $total_not_operative += now()->diffInSeconds($current_report);
                }

                if ($report->reporttype->in_emergency) {
                    $total_emergency += now()->diffInSeconds($current_report);
                }
            }

            $prev_report = $report;
        }

        $formatTime = function ($total) {
            $days = floor($total / 86400);
            $hours = floor(($total / 3600) % 24);
            $minutes = floor(($total / 60) % 60);
            $seconds = $total % 60;
            return $days . "d, " . $hours . "h, " . $minutes . "m, " . $seconds . "s";
        };

        $total_text = $formatTime($time);
        $operative_text = $formatTime($total_operative);
        $not_operative_text = $formatTime($total_not_operative);
        $emergency_text = $formatTime($total_emergency);

        return (object)[
            'total' => $time,
            'operative' => $total_operative,
            'not_operative' => $total_not_operative,
            'emergency' => $total_emergency,
            'total_text' => $total_text,
            'operative_text' => $operative_text,
            'not_operative_text' => $not_operative_text,
            'emergency_text' => $emergency_text
        ];
    }
}
