<?php

namespace App;
use App;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model {


    public function user() {
      return  $this->belongsTo('App\User');
    }


    public function message(){
      return  $this->hasMany('App\Message');
    }

}


