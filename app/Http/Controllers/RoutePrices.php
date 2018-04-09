<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\RouteContractor;


class RoutePrices extends Controller
{

    public function getRoutePrice() {

        $RoutePrices = \App\RoutePrices::where('route_contractor_id', $_GET['id'])
            ->orderBy('unit_id')
            ->orderBy('ot')
            ->get();

        return view('route-price',
            [
                'routePrices' => $RoutePrices
            ]);

    }


    public function getRoutePriceAdd() {

        $Route = RouteContractor::where('id', $_GET['route_contractor_id'])->get();

        if ($Route[0]->contractor->onlycube){
            $units = Unit::where('id', '!=', '1')
                ->where('id', '!=', '4')
                ->where('id', '!=', '2')
                ->get();
        }
        else{
            $units = Unit::where('id', '!=', '1')
                ->where('id', '!=', '4')
                ->get();
        }


        return view('route-price-add',
            [
                'route' => $Route[0],
                'units'=>$units
            ]);

    }

    public function postRoutePriceAdd() {

        $RoutePrices = new \App\RoutePrices();

        $RoutePrices->unit_id = $_POST['unit'];
        $RoutePrices->ot = $_POST['ot'];
        $RoutePrices->do = $_POST['do'];
        $RoutePrices->price = $_POST['price'];
        $RoutePrices->route_contractor_id = $_POST['route_contractor_id'];


        $RoutePrices->save();

        return redirect()->route('route-price',["id" => $_POST['route_contractor_id']]);

    }


    /**
     * Получаем цену в таблицу документа
     *
     * @param integer route_contractor_id
     * @return price
     */
    public function getRoutePriceDoc(){

            return \App\RoutePrices::RoutePriceDocKgM3($_GET['value_kg'],$_GET['value_m3'],$_GET['route_contractor_id']);

    }

    public function deleteRoutePrice() {

        \App\RoutePrices::destroy($_POST['id']);

        return redirect()->route('route-price',["id" => $_POST['route_contractor_id']]);
    }
}
