<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RouteContractor;
use App\Contractor;
use App\City;


class RoutesContractors extends Controller
{


    public function getContractorRoutes() {

        $Routes = RouteContractor::where('contractor_id', $_GET['id'])->get();

        return view('contractor-routes',
                                             [
                                                 'routes' => $Routes,
                                                 'contractor_id' => $_GET['id']
                                             ]);

    }

    public function getContractorRoutesSelect() {

        $res = RouteContractor::where('contractor_id', $_GET['id'])->get();

        $json_all = [];
        foreach ($res as $js) {


            $json_all[] = [
                'id' => $js->id,
                'from' => $js->city_from->name,
                'in' => $js->city_in->name
            ];
        }

        return json_encode($json_all);
    }


    public function getContractorRouteAdd() {

        $contractors = Contractor::where('id', $_GET['contractor_id'])->get();

        $cities = City::all();

        return view('contractor-route-add',
            [
                'contractors' => $contractors,
                'cities'=>$cities
            ]);

    }

    public function postContractorRouteAdd() {

        $RouteContractor = new RouteContractor();

        $RouteContractor->from_id = $_POST['from'];
        $RouteContractor->in_id = $_POST['in'];
        $RouteContractor->contractor_id = $_POST['contractor_id'];
        $RouteContractor->save();

        return redirect()->route('contractor-routes',["id" => $_POST['contractor_id']]);

    }

    public function deleteContractorRoute() {

        RouteContractor::destroy($_POST['id']);

        return redirect()->route('contractor-routes',["id" => $_POST['contractor_id']]);
    }

}
