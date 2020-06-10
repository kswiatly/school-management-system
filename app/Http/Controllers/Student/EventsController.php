<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Events;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Events::all();
        return view('student.events.index')->with('events', Events::paginate(10));
    }
}
