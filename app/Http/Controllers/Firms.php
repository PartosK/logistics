<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Firm;

class Firms extends Controller
{
    public function getFirmAdd() {

        return view('firm-add');

    }


    public function getFirmsList() {

       $firms = Firm::all();

        return view('firms-list',['firms' => $firms]);

    }

    public function getFirmEdit() {

        $firm = Firm::find($_GET['id']);

        return view('firm-edit',['firm' => $firm]);

    }

    public function postFirmSave(){

        if (isset($_POST['id'])){
            $firm = Firm::find($_POST['id']);
        }
        else{
            $firm = new Firm();
        }


        $firm->name = $_POST['name'];
        $firm->address = $_POST['address'];
        $firm->inn = $_POST['inn'];
        $firm->kpp = $_POST['kpp'];
        $firm->account = $_POST['account'];
        $firm->phone = $_POST['phone'];
        $firm->director = $_POST['director'];
        $firm->buh = $_POST['buh'];
        $firm->namebank = $_POST['namebank'];
        $firm->bikbank = $_POST['bikbank'];
        $firm->accountbank = $_POST['accountbank'];

       $firm->save();

        return redirect()->route('firms-list');
    }

    public function deleteFirm() {

        Firm::destroy($_POST['id']);

        return redirect()->route('firms-list');
    }
}
