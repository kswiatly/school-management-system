<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AveragesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('student.averages.index');
    }
}
