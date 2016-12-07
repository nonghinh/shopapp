<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $table = 'event_types';
    protected $fillable = ['name','slug,', 'icon'];

    public $timestamps = false;

}
