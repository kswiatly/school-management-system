@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Events</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                        @foreach($events as $event)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->time }}</td>
                                <td> 
                                    @can('edit-events')
                                    <a href="{{ route('admin.events.edit', $event->id) }}">
                                        <button type="button" class="btn btn-primary float-left mr-3">Edit</button>
                                    </a>
                                    @endcan
                                    @can('delete-events')
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @php
                            $i+=1;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    @can('create-events')
                    <div class="text-center"> 
                        <a href="{{ route('admin.events.create') }}">
                            <button type="button" class="btn btn-primary float-left">Add new event</button>
                        </a>
                    </div>
                    @endcan
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
