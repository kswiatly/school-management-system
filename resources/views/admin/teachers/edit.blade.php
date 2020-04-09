@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit teacher {{ DB::table('users')->where('id', '=', $teacher->user_id)->value('name') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.teachers.update', $teacher, $subjects) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="subjects" class="col-md-2 col-form-label text-md-right">Subjects</label>  
                            <div class="col-md-6">
                                @foreach($subjects as $subject)
                                <div class="form-check">
                                    <input type="checkbox" name="subjects[]" value="{{ $subject->name }}" @if($teacher->subjects->pluck('id')->contains($subject->id)) checked @endif>
                                    <label>{{ $subject->name }}</label>
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
