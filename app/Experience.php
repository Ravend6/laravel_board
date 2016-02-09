<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'user_id',
        'company',
        'position',
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
