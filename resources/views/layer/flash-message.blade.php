@if (session('success'))

    <div class="row">
        <div class="col-12 alert alert-success">
            {{ session('success') }}
        </div>
    </div>

@endif

@if (session('warning'))

    <div class="row">
        <div class="col-12 alert alert-warning">
            {{ session('warning') }}
        </div>
    </div>

@endif

@if (session('danger'))

    <div class="row">
        <div class="col-12 alert alert-danger">
            {{ session('danger') }}
        </div>
    </div>

@endif