<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function users(){
        return $this->belongsTo('App\User');
    }

    public function subjects(){
        return $this->belongsToMany('App\Subject');
    }
}
