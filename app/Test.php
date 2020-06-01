<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function users(){
        return $this->belongsToMany('App\Marks');
    }
}
