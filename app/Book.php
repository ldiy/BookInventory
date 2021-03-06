<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $guarded = [];
    public function _series()
    {
        return $this->belongsTo('App\Serie', 'series');
    }
}
