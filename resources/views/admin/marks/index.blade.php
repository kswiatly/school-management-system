@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Marks</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Class</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Student</th>
                                <th scope="col">Mark</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($marks as $mark)
                            @php
                                $teacherUserID = DB::table('teachers')->where('id', '=', $mark->teacher_id)->value('user_id');

                                $studentUserID = DB::table('students')->where('id', '=', $mark->student_id)->value('user_id');
                            @endphp
                            <tr>
                                <th scope="row">{{ $mark->id }}</th>
                                <td>{{DB::table('classes')->where('id', '=', $mark->class_id)->value('name')}}</td>
                                <td>{{DB::table('users')->where('id', '=', $teacherUserID)->value('name')}}</td>
                                <td>{{DB::table('subjects')->where('id', '=', $mark->subject_id)->value('name')}}</td>
                                <td>{{DB::table('users')->where('id', '=', $studentUserID)->value('name')}}</td>
                                <td>{{ $mark->mark }}</td>
                                <td>
                                    @can('edit-marks')
                                    <a href="{{ route('admin.marks.edit', $mark->id) }}">
                                        <button type="button" class="btn btn-primary float-left mr-3">Edit</button>
                                    </a>
                                    @endcan
                                    @can('delete-marks')
                                    <form action="{{ route('admin.marks.destroy', $mark->id) }}" method="POST" class="float-left">
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
                    @can('create-marks')
                    <div class="text-center"> 
                        <a href="{{ route('admin.marks.create') }}">
                            <button type="button" class="btn btn-primary float-left">Add new mark</button>
                        </a>
                    </div>
                    @endcan
                    {{ $marks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
