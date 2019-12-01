<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    protected $fillable = [
        'id',
        'title',
        'address',
        'place_name',
        'date_from',
        'date_to',
        'description',
        'slug',
        'country_id',
        'city_id',
        'cover',
        'video',
        'link',
        'facebook',
    ];
}
