<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'country_code_2',
    ];

    public function executants()
    {
        return $this->belongsToMany('App\Executant');
    }
}
