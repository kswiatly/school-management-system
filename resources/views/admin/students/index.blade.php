@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Class</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <th scope="row">{{ $student->id }}</th>
                                <td>{{DB::table('users')->where('id', '=', $student->user_id)->value('name')}}</td>
                                <td>{{DB::table('users')->where('id', '=', $student->user_id)->value('email')}}</td>
                                <td>{{DB::table('classes')->where('id', '=', $student->class_id)->value('name')}}</td>
                                <td>
                                    @can('edit-students')
                                    <a href="{{ route('admin.students.edit', $student->id) }}">
                                        <button type="button" class="btn btn-primary float-left mr-3">Edit</button>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
