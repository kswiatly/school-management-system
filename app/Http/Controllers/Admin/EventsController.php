<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events;
use Gate;
use Auth;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Events::all();
        return view('admin.events.index')->with('events', Events::paginate(10));
    }
    public function create(Events $event)
    {
        if(Gate::denies('create-events')){
            return redirect(route('admin.events.index'));
        }
        
        return view('admin.events.create')->with([
            'events'=> $event,
        ]);
    }

    public function store(Request $request)
    {
        $event = new Events;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;

        if($event->save())
        {
            $request->session()->flash('success', 'Event has been created');
        }
        else{
            $request->session()->flash('error','There was an error during creating the event');
        }
        return redirect('/admin/events');
    }

    public function destroy(Events $event)
    {
        if(Gate::denies('delete-events')){
            return redirect()->route('admin.events.index');
        }
        
        if($event->delete()){
            session()->flash('success', 'Event has been deleted');
        }
        else{
            session()->flash('error','There was an error during deleting the event');
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Events $event)
    {
        if(Gate::denies('edit-events')){
            return redirect(route('admin.events.index'));
        }
        
        return view('admin.events.edit')->with([
            'events'=> $event,
        ]);
    }

    public function update(Request $request, Events $event)
    {
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        
        if($event->save()){
            $request->session()->flash('success', 'Event has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the event');
        }

        return redirect()->route('admin.events.index');
    }
}
