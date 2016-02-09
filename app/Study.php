<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
        'user_id',
        'institution',
        'specialization',
        'from',
        'to',
        'description',
        'is_present',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
