<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pretension extends Model
{
    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }

    public static function close($id){

        $spice = Pretension::find($id);
        $spice->close = true;
        $spice->save();
    }

}
