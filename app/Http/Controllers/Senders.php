<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sender;

class Senders extends Controller
{
    public function getSenderAdd() {

        return view('sender-add');

    }


    public function getSendersList() {

        $Senders = Sender::all();

        return view('senders-list',['senders' => $Senders]);

    }


    public function postSenderAdd(){

        $sender = new Sender();
        $sender->name = $_POST['name'];
        $sender->contractor_id = $_POST['contractor_id'];
        $sender->save();

        return redirect()->route('senders-list');
    }

    public function getSenderFind(){
        $name = $_GET['term'];

        return Sender::findSender($name);
    }


    public function deleteSender() {

        Sender::destroy($_POST['id']);

        return redirect()->route('senders-list');
    }
}
