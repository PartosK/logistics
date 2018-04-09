<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doc extends Model
{

    use SoftDeletes;


    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }

    public function route_contractors()
    {
        return $this->belongsTo('App\RouteContractor');
    }

    public function doc_type()
    {
        return $this->belongsTo('App\DocType');
    }

    public function service_type()
    {
        return $this->belongsTo('App\ServiceType');
    }



    public function spice()
    {
        return $this->belongsTo('App\Spice');
    }

    public function firm()
    {
        return $this->belongsTo('App\Firm');
    }
}
