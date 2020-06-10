@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Classes</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Tutor</th>
                                <th scope="col">Chairman</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                        @foreach($classes as $class)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->description }}</td>
                                <td>{{DB::table('users')->where('id', '=', $class->tutor_id)->value('name')}}</td>
                                <td>{{DB::table('users')->where('id', '=', $class->chairman_id)->value('name')}}</td>
                                <td>
                                    @can('edit-classes')
                                    <a href="{{ route('admin.classes.edit', $class->id) }}">
                                        <button type="button" class="btn btn-primary float-left mr-3">Edit</button>
                                    </a>
                                    @endcan
                                    @can('delete-users')
                                    <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="float-left">
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
                    @can('create-classes')
                    <div class="text-center"> 
                        <a href="{{ route('admin.classes.create') }}">
                            <button type="button" class="btn btn-primary float-left">Add new class</button>
                        </a>
                    </div>
                    @endcan
                    {{ $classes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
