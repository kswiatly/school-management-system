<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function users(){
        return $this->$this->belongsTo('App\User');
    }
}
