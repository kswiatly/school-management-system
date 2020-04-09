@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subjects</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <th scope="row">{{ $subject->id }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->description }}</td>
                                <td>
                                    @can('edit-subjects')
                                    <a href="{{ route('admin.subjects.edit', $subject->id) }}">
                                        <button type="button" class="btn btn-primary mb-3">Edit</button>
                                    </a>
                                    @endcan
                                    @can('delete-subjects')
                                    <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @can('create-subjects')
                    <div class="text-center"> 
                        <a href="{{ route('admin.subjects.create') }}">
                            <button type="button" class="btn btn-primary float-left">Add new subject</button>
                        </a>
                    </div>
                    @endcan
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
