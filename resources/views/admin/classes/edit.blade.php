@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit class {{ $class->name }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.classes.update', $class) }}" method="POST">
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $class->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $class->description }}" required autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="tutor" class="col-md-2 col-form-label text-md-right">Tutor</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="tutor">
                                @foreach($teachers as $teacher)
                                    <option name="teachers[]" value="{{ $teacher->user_id }}" @if($teacher->user_id==$class->tutor_id) selected @endif>
                                    <label>{{ DB::table('users')->where('id', '=', $teacher->user_id)->value('name') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="chairman" class="col-md-2 col-form-label text-md-right">Chairman</label>  
                            <div class="col-md-6">
                                <select class="form-control" name="chairman">
                                @foreach($students as $student)
                                    <option name="students[]" value="{{ $student->user_id }}" @if($student->user_id==$class->chairman_id) selected @endif>
                                    <label>{{ DB::table('users')->where('id', '=', $student->user_id)->value('name') }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        
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
