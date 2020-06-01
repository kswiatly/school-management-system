@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit mark {{ $marks->id }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.marks.update', $marks) }}" method="POST">
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                            <label for="class" class="col-md-2 col-form-label text-md-right">Class</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="class">
                                @foreach($classes as $class)
                                    <option name="classes[]" value="{{ $class->id }}">
                                    <label>{{ DB::table('classes')->where('id', '=', $class->id)->value('name') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        @can('manage-users')
                        <div class="form-group row">
                            <label for="teacher" class="col-md-2 col-form-label text-md-right">Teacher</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="teacher">
                                @foreach($teachers as $teacher)
                                    <option name="teachers[]" value="{{ $teacher->user_id }}">
                                    <label>{{ DB::table('users')->where('id', '=', $teacher->user_id)->value('name') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        @endcan

                        <div class="form-group row">
                            <label for="subject" class="col-md-2 col-form-label text-md-right">Subject</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="subject">
                                @foreach($subjects as $subject)
                                    <option name="subjects[]" value="{{ $subject->id }}">
                                    <label>{{ DB::table('subjects')->where('id', '=', $subject->id)->value('name') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="student" class="col-md-2 col-form-label text-md-right">Student</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="student">
                                @foreach($students as $student)
                                    <option name="students[]" value="{{ $student->user_id }}">
                                    <label>{{ DB::table('users')->where('id', '=', $student->user_id)->value('name') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="test" class="col-md-2 col-form-label text-md-right">Test</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="test">
                                @foreach($tests as $test)
                                    <option name="tests[]" value="{{ $test->id }}">
                                    <label>{{ DB::table('tests')->where('id', '=', $test->id)->value('description') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mark" class="col-md-2 col-form-label text-md-right">Mark</label>

                            <div class="col-md-6">
                                <input id="description" type="number" name="mark" min="1" max="5" required autofocus>
                            </div>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
