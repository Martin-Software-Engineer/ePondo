@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-4">
                <h1 class="mt-1">Edit Job</h1>
                <form method="POST" action="{{ route('jobseeker.campaigns.update',$campaign->id) }}">
                        @method('PATCH')
                        @include('jobseeker.campaigns.partials.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection