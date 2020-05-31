<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    public function users(){
        return $this->belongsToMany('App\Student');
    }
}
