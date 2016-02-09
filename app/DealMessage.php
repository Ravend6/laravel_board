<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealMessage extends Model
{
    protected $table = 'deal_messages';

    protected $fillable = [
        'task_id',
        'user_id',
        'proposition_id',
        'is_confirmed',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function proposition()
    {
        return $this->belongsTo('App\Proposition');
    }
}
