<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{

    public static function findContractor($name){

        $results = self::where('name','like', '%'.$name.'%' )->get();

        foreach ($results as $result) {

            $json[] = array('label' => $result->name,
                'value' => $result->name,
                'id' => $result->id,
                'payment_bank' => $result->payment_bank,
                'payment_cash' => $result->payment_cash
            );


        }
        if (isset( $json )) {
            return json_encode($json);
        }
    }
}
