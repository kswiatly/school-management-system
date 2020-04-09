@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-danger" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if(session('errror'))
    <div class="alert alert-error" role="alert">
        {{ session('errror') }}
    </div>
@endif