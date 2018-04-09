<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc_tr extends Model
{
    public function doc()
    {
        return $this->belongsTo('App\Doc');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
