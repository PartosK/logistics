<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RouteContractor;

class RoutePrices extends Model
{

    public static function RoutePriceDocKgM3($value_kg, $value_m3, $route_contractor_id){

        $RouteContractor = RouteContractor::where('id', $route_contractor_id)->get();
        if ($RouteContractor[0]->contractor->total_price_transport) {
            return \App\RoutePrices::RoutePriceDocAll($value_kg, $value_m3, $route_contractor_id);
        } else {
            return \App\RoutePrices::RoutePriceDocPersonal($value_kg, $value_m3, $route_contractor_id);
        }

    }


    public static function RoutePriceDocAll($value_kg, $value_m3, $route_contractor_id){

        $RouteContractor = RouteContractor::where('id', $route_contractor_id)->get();

        $density = 230;

        if ($value_m3 != 0) {
            $koef = $value_kg / $value_m3;
        }
        else{
            $koef = 0;
        }

        if ($koef < $density){
            //m3
            $unit_id = 3;
            $value = $value_m3;
        }
        else{
            // kg
            $unit_id = 2;
            $value = $value_kg;
        }



        $Route = \App\RoutePricesAll::where('city_from_id', $RouteContractor[0]->from_id)
            ->where('city_in_id', $RouteContractor[0]->in_id)
            ->where('unit_id', $unit_id)
            ->where(function ($query) use ($value) {
                $query->where('ot', '<=',  $value )
                    ->where('do', '>=', $value);
            })
            //   ->toSql();
            ->get();
//dump($Route);
        if ($Route->isEmpty()) {
            return null;
        }
        else {
            return json_encode([
                'price'   => $Route[0]->price,
                'unit_id' => $unit_id
            ]);
        }
    }

    public static function RoutePriceDocPersonal($value_kg, $value_m3, $route_contractor_id){

        $RouteContractor = RouteContractor::where('id', $route_contractor_id)->get();

        $density = $RouteContractor[0]->contractor->density;

        if ($value_m3 != 0) {
            $koef = $value_kg / $value_m3;
        }
        else{
            $koef = 0;
        }

        if ($koef < $density){
            //m3
            $unit_id = 3;
            $value = $value_m3;
        }
        else{
            // kg
            $unit_id = 2;
            $value = $value_kg;
        }


        $Route = \App\RoutePrices::where('route_contractor_id', $route_contractor_id)
            ->where('unit_id', $unit_id)
            ->where(function ($query) use ($value) {
                $query->where('ot', '<=',  $value )
                    ->where('do', '>=', $value);
            })
            //   ->toSql();
            ->get();

        if ($Route->isEmpty()) {
            return null;
        }
        else {
            return json_encode([
                'price'   => $Route[0]->price,
                'unit_id' => $unit_id
            ]);
        }
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
