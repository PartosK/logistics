<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoutePricesAll extends Model
{
    protected $table = 'route_prices_all';

    public function city_in()
    {
        return $this->belongsTo('App\City', 'city_in_id');
    }

    public function city_from()
    {
        return $this->belongsTo('App\City', 'city_from_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }


}
