<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spice;
use App\Doc;

class Spices extends Controller
{
    public function getSpiceAdd() {

        return view('spice-add');

    }

    public function putSpiceClose() {

        Spice::close($_POST['id']);

        return redirect()->route('spices-list');
    }

    public function deleteSpiceDelete() {

        Spice::destroy($_POST['id']);

        return redirect()->route('spices-list');
    }

    public function getSpicesList() {

        $spices = Spice::all();

        return view('spices-list',['spices' => $spices]);

    }

    /*
     * @TODO сделать вывод цены с копейками
     */
    public function getSpicesListDoc() {

        $allPrice = Spice::allPrice($_GET['id']);
        $docs = Doc::where('spice_id',$_GET['id'])->get();
        return view('spices-list-doc',
            [
            'docs' => $docs,
            'allPrice' => $allPrice
            ]);

    }

    public function postSpiceAdd(Request $request){

        $rules = [
            'number'=> 'required|max:255|integer',
            'prefix'=> 'required|alpha'
        ];

        $this->validate($request,$rules);

        $spice = new Spice();

        $spice->number = $_POST['number'];
        $spice->prefix = $_POST['prefix'];
        $spice->date = date('Y-m-d', strtotime($_POST['date']));

        $spice->save();

        return redirect()->route('spices-list');
    }

}
