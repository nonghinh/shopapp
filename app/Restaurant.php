<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = ['name', 'slug', 'address', 'location', 'email', 'phone', 'website', 'description-place'];
}
