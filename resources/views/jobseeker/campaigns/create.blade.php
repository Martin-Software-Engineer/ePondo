@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create Campaign</h1>
            <div class="card">

                <form method="POST" action="{{ route('jobseeker.campaigns.store') }}">
                    @include('jobseeker.campaigns.partials.form')
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
