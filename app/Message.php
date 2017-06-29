<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'approved',
    ];




    public function user(){
      return  $this->belongsTo('App\User');
    }

    public function thread(){
      return  $this->belongsTo('App\Thread');
    }

}
