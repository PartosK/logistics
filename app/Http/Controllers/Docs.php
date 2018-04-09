<?php

namespace App\Http\Controllers;

use App\Sender;
use Illuminate\Http\Request;
use App\Doc;
use App\Doc_tr;
use App\Spice;
use App\Firm;
use App\Contractor;
use App\Pretension;
use App\RouteContractor;

class Docs extends Controller
{

    public function getDocBank() {

        $doc = Doc::where('id',$_GET['id'])->get();
        $doc_tr = Doc_tr::where('doc_id',$_GET['id'])->get();


        if (false == $doc_tr->isEmpty()) {

            return view('doc-bank', [
                'doc' => $doc[0],
                'total_price_rub' => explode('.', $doc[0]->total_price),
                'doc_tr' => $doc_tr
            ]);

        }
        else {

            $data = [
                'id' => $doc[0]->id,
                'firm' => $doc[0]->firm,
                'spice' => $doc[0]->spice,
                'number' => $doc[0]->number,
                'date' => $doc[0]->date,
                'contractor' => $doc[0]->contractor,
                'routecontractor' => $doc[0]->route_contractors
            ];

            return view('doc-table-add-bank', $data);
        }
    }

    public function getDocCash() {

        $doc = Doc::where('id',$_GET['id'])->get();
        $doc_tr = Doc_tr::where('doc_id',$_GET['id'])->get();

        if (false == $doc_tr->isEmpty()) {
            return view('doc-cash', [
                'doc' => $doc[0],
                'total_price_rub' => explode('.', $doc[0]->total_price),
                'doc_tr' => $doc_tr
            ]);
        }
        else {

            $data = [
                'id' => $doc[0]->id,
                'firm' => $doc[0]->firm,
                'spice' => $doc[0]->spice,
                'number' => $doc[0]->number,
                'date' => $doc[0]->date,
                'contractor' => $doc[0]->contractor,
                'routecontractor' => $doc[0]->route_contractors
            ];

            return view('doc-table-add-cash', $data);
        }

    }

    public function getDocsList() {

        $docs = Doc::all();

        return view('docs-list',['docs' => $docs]);

    }

    public function getDocHeadAdd() {

        $number = Doc::all()->max('number');
        $number_sp = preg_match("/[^a-z0-9]/", $number,$matches);
        if($number_sp){
            $number = strstr($number, $matches[0], true); // This is
        }
        $number = $number + 1;

        $spices = Spice::allopen();
        $firms = Firm::all();

        return view('doc-head-add',[
            'spices' => $spices,
            'firms'  => $firms,
            'number' => $number
                                        ]);

    }

    public function postDocTableAdd(Request $request) {


        $rules = [
            'spice_id'=> 'required|integer',
            'contractor_id'=> 'required|integer',
            'route_contractors_id'=> 'required|integer',
            'doctype_id'=> 'required|integer'
        ];
        $messages = array(
            'contractor_id.required' => 'Не выбран контрагент',
            'route_contractors_id.required' => 'Не выбран маршрут контрагента',
            'doctype_id.required' => 'Не выбран тип расчета контрагента',
        );

        $this->validate($request,$rules,$messages);


       // $number = Doc::all()->max('number');
        $spice      = Spice::where('id', $_POST['spice_id'])->get();
        $firm       = Firm::where('id', $_POST['firm_id'])->get();
        $contractor = Contractor::where('id', $_POST['contractor_id'])->get();
        $routecontractor = RouteContractor::where('id', $_POST['route_contractors_id'])->get();

       // $number = $number + 1;
        $addDoc = new Doc();
        $addDoc->number = $_POST['number'];
        $addDoc->firm_id = $_POST['firm_id'];
        $addDoc->date = date('Y-m-d',strtotime($_POST['date']));
        if (isset($_POST['date_issue'])){
            $addDoc->date_issue = date('Y-m-d', strtotime($_POST['date_issue']));
        }
        else{
            $addDoc->date_issue = null;
        }
        $addDoc->contractor_id = $_POST['contractor_id'];
        $addDoc->spice_id = $_POST['spice_id'];
        $addDoc->route_contractors_id = $_POST['route_contractors_id'];
        $addDoc->doc_type_id = $_POST['doctype_id'];
        $addDoc->save();
        $id = $addDoc->id;


        $data = [
            'id' => $id,
            'firm' => $firm[0],
            'spice' => $spice[0],
            'number' => $_POST['number'],
            'date' => $_POST['date'],
            'contractor' => $contractor[0],
            'routecontractor' => $routecontractor[0]
        ];

        if (1 == $_POST['doctype_id']) {
            return view('doc-table-add-bank', $data);
        }
        else{
            return view('doc-table-add-cash', $data);
        }

    }

    public function postDocTableAddSave()
    {
        $doc_id =  $_POST['doc_id'];
        $mass   =  $_POST['mass'];
        $total_price =  $_POST['total_price'];
        $doc    = Doc::find($doc_id);

        if (isset($_POST['date_issue'])){

            $doc->date_issue = date('Y-m-d', strtotime($_POST['date_issue']));
            $doc->save();
        }

            foreach ($mass as $value) {

                $doc_tr = new Doc_tr();

                if ($value['servicetype'] == 1) {
                    $doc_tr->service = $value['service'] . " (" . $value['ht'] . "шт;" . $value['kg'] . "кг;" . $value['m3'] . "м3;) ";
                    $doc_tr->route_contractor = $value['routecontractor'];

                    $namSender = Sender::findByNameSender($value['sender']);

                    if ($namSender->isEmpty()){
                        $sender = new Sender();
                        $sender->name = $value['sender'];
                        $sender->contractor_id = $doc->contractor_id;
                        $sender->save();
                    }
                    $doc_tr->sender = " ОТПР. ". $value['sender'];

                } else {
                    $doc_tr->service = $value['service'];
                }
                if ($value['servicetype'] == 1) {
                    $doc_tr->different = $value['requirement'];
                }
                if ($value['servicetype'] == 5) {
                    $doc_tr->different = 'ЭР';
                }

                if ($value['servicetype'] == 4) {
                    $arr = explode(",", $value['pretension']);

                    $pretension = Pretension::where('id',$arr[0])->get();
                    $ostatok = $pretension[0]->ostatok + $value['total_price_tr'];
                    $pretension[0]->ostatok = $ostatok ;
                    if ($ostatok == 0){
                        $pretension[0]->close = true;
                    }
                    $pretension[0]->save();

                }
                $doc_tr->service_types_id = $value['servicetype'];

                if (isset($value['unit']) ) {
                    $unit = $value['unit'];
                }
                else{
                    $unit = 4;
                }

             //   dd($value['count']);
                if (isset($value['count']) ) {
                    $count = $value['count'];
                }
                else{
                    $count = 1;
                }

                $doc_tr->unit_id = $unit;
                $doc_tr->doc_id = $doc_id;

                $doc_tr->count = $count;
                $doc_tr->price = $value['price'];
                $doc_tr->total_price_tr = $value['total_price_tr'];
                $doc_tr->trnumber = $value['trnumber'];
                $doc_tr->save();

                $doc = $doc_tr->doc;
                $doc->total_price = $total_price;
                $doc->save();
            }


        return redirect()->route('docs-list');
    }

    public function deleteDoc() {

        Doc::destroy($_POST['id']);

        if (isset($_POST['spice_id'])){
            return redirect()->route('spices-list-doc', ['id' => $_POST['spice_id']]);
        }
        else{
            return redirect()->route('docs-list');
        }

    }
}
