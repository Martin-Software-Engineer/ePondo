@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create Product</h1>
            <div class="card">
                <form method="POST" action="{{ route('jobseeker.campaigns.products.store',$campaign_id) }}">
                    @include('jobseeker.products.partials.form',['create' => true])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
