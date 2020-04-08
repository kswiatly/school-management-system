@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teachers</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <th scope="row">{{ $teacher->id }}</th>
                                <td>{{DB::table('users')->where('id', '=', $teacher->user_id)->value('name')}}</td>
                                <td>{{DB::table('users')->where('id', '=', $teacher->user_id)->value('email')}}</td>
                                <td>
                                    @can('edit-teachers')
                                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}">
                                        <button type="button" class="btn btn-primary float-left mr-3">Edit</button>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
