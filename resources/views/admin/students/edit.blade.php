@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit student {{ DB::table('users')->where('id', '=', $student->user_id)->value('name') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.students.update', $student) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="classes" class="col-md-2 col-form-label text-md-right">Classes</label>  
                            <div class="col-md-6">
                                @foreach($classes as $class)
                                <div class="form-check">
                                    <input type="radio" name="classes[]" value="{{ $class->name }}" @if($student->pluck('class_id')->contains($class->id)) checked @endif>
                                    <label>{{ $class->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
