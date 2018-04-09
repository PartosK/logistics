<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doc;
use App\Doc_tr;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;

abstract class DocWord extends Model
{

    public static function DocWordSave($id){

    }

    public static function DocWordDownload($id)
    {
        $save_file_name = static::DocWordSave($id);

        return response()->download($save_file_name)->deleteFileAfterSend(true);
    }

    public static function DocWordEmail($id)
    {

        $doc    = Doc::where('id', $id)->get();
        $email = $doc[0]->contractor->email;
        $save_file_name = static::DocWordSave($id);

        $data= [];
        \Mail::send('emails.welcome', $data, function ($message) use ($save_file_name, $email) {
            $message->from('partos.wow@gmail.com', 'МТК');
            $message->to($email)->subject('Ваш счет от транспортной компании');
            $message->attach($save_file_name);
        });


       return  $files =  unlink(__DIR__ . '/../public/'. $save_file_name);


    }
}
