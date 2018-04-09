<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spice extends Model
{
    use SoftDeletes;


    public static function close($id){

        $spice = Spice::find($id);
        $spice->close = true;
        $spice->save();
    }

    public  function docSpice(){

        return $this->hasMany('\App\Doc');
    }

    public static function allopen(){

        return Spice::where('close','=','false')->get();
    }

    public static function allPrice($id){
        $docs = Doc::where('spice_id',$id)->get();

        $total_price_spice = 0;
        foreach ($docs as $doc){
           $total_price = $doc->total_price;
            $total_price_spice += $total_price;
        }
        return   round($total_price_spice,2);
    }
}
