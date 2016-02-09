<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'user_id',
        'image_id',
        'title',
        'description',
    ];

    // public function users()
    // {
    //     return $this->belongsToMany('App\Album');
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    // public function image()
    // {
    //     return $this->hasOne('App\Image');
    // }

    public function getImageAttribute()
    {
        foreach ($this->images as $image) {
            if ($image->id == $this->image_id) {
                return $image;
            }
        }
        return null;
    }
}
