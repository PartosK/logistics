<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    public static function findSender($name){

        $results = self::where('name','like', '%'.$name.'%' )->get();

        foreach ($results as $result) {

            $json[] = array('label' => $result->name,
                'value' => $result->name,
                'id' => $result->id
            );


        }
        if (isset( $json )) {
            return json_encode($json);
        }
    }

    public static function findByNameSender($name){
       return self::where('name','=', $name)->get();
    }

    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }
}
