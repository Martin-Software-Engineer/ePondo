@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create Job</h1>
            <div class="card">
                <form method="POST" action="{{ route('jobseeker.campaigns.jobs.store',$campaign_id) }}" enctype="multipart/form-data">
                    @include('jobseeker.jobs.partials.form',['create' => true])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
