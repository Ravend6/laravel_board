<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'album_id',
        'title',
        'description',
        'name',
    ];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
