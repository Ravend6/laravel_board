<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{
    protected $fillable = [
        'task_id',
        'user_executant_id',
        'price',
        'description',
        'date_begin',
        'is_confirmed',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_executant_id');
    }
}
