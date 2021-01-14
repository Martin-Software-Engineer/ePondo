@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mt-1">Edit Job</h1>
            <div class="card mt-4">
                <form method="POST" action="{{ route('jobseeker.campaigns.jobs.update',[$campaign, $job->id]) }}">

                    @method('PATCH')
                    @include('jobseeker.jobs.partials.form')

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection