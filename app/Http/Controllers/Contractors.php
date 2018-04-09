<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;

class Contractors extends Controller
{
    public function getContractorAdd() {

        return view('contractor-add');

    }


    public function getContractorsList() {

        $Contractors = Contractor::all();

        return view('contractors-list',['contractors' => $Contractors]);

    }

    public function getContractorEdit() {

        $Contractor = Contractor::find($_GET['id']);

        return view('contractor-edit',['contractor' => $Contractor]);

    }


    public function postContractorSave(){

        if (isset($_POST['id'])){
            $Contractor = Contractor::find($_POST['id']);
        }
        else{
            $Contractor = new Contractor();
        }

        $Contractor->name = $_POST['name'];
        $Contractor->inn = $_POST['inn'];
        $Contractor->phone = $_POST['phone'];
        $Contractor->email = $_POST['email'];
        $Contractor->account = $_POST['account'];
        $Contractor->density = $_POST['density'];
        $Contractor->ton_one_weight = $_POST['ton_one_weight'];
        $Contractor->ton_one_place = $_POST['ton_one_place'];

        if (isset($_POST['onlycube'])) {
            $Contractor->onlycube = true;
        } else {
            $Contractor->onlycube = false;
        }

        if (isset($_POST['payment_cash'])) {
            $Contractor->payment_cash = true;
        } else {
            $Contractor->payment_cash = false;
        }

        if (isset($_POST['payment_bank'])) {
            $Contractor->payment_bank = true;
        } else {
            $Contractor->payment_bank = false;
        }
        if (isset($_POST['total_price_transport'])) {
            $Contractor->total_price_transport = true;
        } else {
            $Contractor->total_price_transport = false;
        }

        $Contractor->save();

        return redirect()->route('contractors-list');
    }

    public function getContractorFind(){
        $name = $_GET['term'];

        return Contractor::findContractor($name);
    }

    public function deleteContractor() {

        Contractor::destroy($_POST['id']);

        return redirect()->route('contractors-list');
    }

}
