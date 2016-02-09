<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Executant extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'hourly_wage',
        'description',
    ];

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }

    public function driverLicenses()
    {
        return $this->belongsToMany('App\DriverLicense');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getLanguageListAttribute()
    {
        return $this->languages->lists('id')->toArray();
    }

    public function getDriverLicenseListAttribute()
    {
        return $this->driverLicenses->lists('id')->toArray();
    }
}
