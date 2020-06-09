@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit event {{ $events->name }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $events) }}" method="POST">

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $events->name }}" required autofocus>

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
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $events->description }}" required autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label text-md-right">Date</label>

                            <div class="col-md-6">
                                <input id="date" type="date" name="date" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-2 col-form-label text-md-right">Time</label>

                            <div class="col-md-6">
                                <input id="time" type="time" name="time" required autofocus>
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
