<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'storeNumber',
        'storeName',
        'address',
        'siteId',
        'lat',
        'lon',
        'phonenumber',
        'cfgsFlag',
        'invalidFields'
    ];
}
