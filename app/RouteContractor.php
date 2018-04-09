<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteContractor extends Model
{
    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }

    public function city_in()
    {
        return $this->belongsTo('App\City', 'in_id');
    }

    public function city_from()
    {
        return $this->belongsTo('App\City', 'from_id');
    }
}
