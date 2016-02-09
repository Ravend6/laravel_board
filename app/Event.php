<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function logs()
    {
        return $this->hasMany('App\Logs');
    }
}
