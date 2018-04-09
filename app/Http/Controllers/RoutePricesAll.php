<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\City;

class RoutePricesAll extends Controller
{

    public function getRoutePriceAll() {

        $RoutePricesAll = \App\RoutePricesAll::orderBy('city_from_id')
            ->orderBy('unit_id')
            ->orderBy('ot')
            ->get();

        return view('route-price-all',
            [
                'routePricesAll' => $RoutePricesAll
            ]);

    }


    public function getRoutePriceAllAdd() {

            $units = Unit::where('id', '!=', '1')
                ->where('id', '!=', '4')
                ->get();


        $cities = City::all();

        return view('route-price-all-add',
            [
                'cities' => $cities,
                'units'=>$units
            ]);

    }

    public function postRoutePriceAllAdd() {

        $routePricesAll = new \App\RoutePricesAll();
        $routePricesAll->city_from_id = $_POST['from'];
        $routePricesAll->city_in_id = $_POST['in'];
        $routePricesAll->unit_id = $_POST['unit'];
        $routePricesAll->ot = $_POST['ot'];
        $routePricesAll->do = $_POST['do'];
        $routePricesAll->price = $_POST['price'];



        $routePricesAll->save();

        return redirect()->route('route-price-all');

    }
}
