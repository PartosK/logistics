<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pretension;

class Pretensions extends Controller
{

    public function getPretensionAdd() {

        return view('pretension-add');

    }

    public function getPretensionsList() {

        $pretensions = Pretension::all();

        return view('pretensions-list',['pretensions' => $pretensions]);

    }

    public function postPretensionAdd(){

        $pretension = new Pretension();

        $pretension->date = date('Y-m-d', strtotime($_POST['date']));
        $pretension->text = $_POST['text'];
        $pretension->price = $_POST['price'];
        $pretension->ostatok = $_POST['price'];
        $pretension->contractor_id = $_POST['contractor_id'];
        $pretension->save();

        return redirect()->route('pretensions-list');
    }


    /**
     * Получаем массив претензий контрагента
     *
     * @param integer $contractor_id
     * @return array
     */
    public function getPretensionContractor(){

        $Pretension = Pretension::where('contractor_id',$_GET['contractor_id'])
            ->where('close','=','false')
            ->get();
        if (isset( $Pretension )) {
            return json_encode($Pretension);
        }
    }


    public function putPretensionClose() {

        Pretension::close($_POST['id']);

        return redirect()->route('pretensions-list');
    }

    public function deletePretension() {

        Pretension::destroy($_POST['id']);

        return redirect()->route('pretensions-list');
    }
}
