@if(session('success'))
    <div class="alert alert-success mt-4" role="alert">
        {{ session('success')}}
    </div>
@endif

@if (session('isAdmin'))
        <div class="alert alert-danger mt-4" role="alert">
            {{ session('isAdmin') }}
        </div>
@endif

@if (session('NoJobseekerBackground'))
        <div class="alert alert-primary mt-4" role="alert">
            {{ session('NoJobseekerBackground') }}
        </div>
@endif
