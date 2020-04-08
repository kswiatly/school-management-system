<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function users(){
        return $this->$this->belongsToMany('App\Student');
    }
}
