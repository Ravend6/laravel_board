<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverLicense extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function executants()
    {
        return $this->belongsToMany('App\Executant');
    }
}
