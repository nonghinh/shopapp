<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRestaurant extends Model
{
    protected $table = 'event_restaurant';
    protected $fillable = ['info_event', 'time_start', 'time_end'];
}
