<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user_customer_id',
        'user_executant_id',
        'category_id',
        'proposition_id',
        'title',
        'slug',
        'description',
        'is_visible',
        'status',
        'date_begin',
        'date_end',
        'email',
    ];

    protected $dates = ['date_begin', 'date_end'];

    public function setDateBeginAttribute($date)
    {
        $this->attributes['date_begin'] = Carbon::parse($date);
        // $this->attributes['date_begin'] = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    }

    public function setDateEndAttribute($date)
    {
        $this->attributes['date_end'] = Carbon::parse($date);
        // $this->attributes['date_end'] = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'user_customer_id');
    }

    public function propositions()
    {
        return $this->hasMany('App\Proposition');
    }
}
