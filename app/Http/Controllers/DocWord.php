<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\DocWord as ModelDocWord;
use \App\DocWordBank;
use \App\DocWordCash;
use \App\Doc;

class DocWord extends Controller
{
    public function getDocWordDownload()
    {
        $doc    = Doc::find($_GET['id']);
        if (1 == $doc->doc_type_id) {
            return DocWordBank::DocWordDownload($_GET['id']);
        }
        else{
            return DocWordCash::DocWordDownload($_GET['id']);
        }
    }

    public function getDocWordEmail()
    {
        $doc    = Doc::find($_GET['id']);
        if (1 == $doc->doc_type_id) {
            DocWordBank::DocWordEmail($_GET['id']);
        }
        else{
            DocWordCash::DocWordEmail($_GET['id']);
        }
        return redirect()->back()->with('email', 'Сообщение отправлено');
    }

}
