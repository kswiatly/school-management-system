<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marks;
use App\Role;
use App\Teacher;
use App\Student;
use App\Classes;
use Gate;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $marks = Marks::all();
        return view('admin.marks.index')->with('marks', Marks::paginate(10));
    }
    
}
