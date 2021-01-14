@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mt-1">Edit Product</h1>
            <div class="card mt-4">
                <form method="POST" action="{{ route('jobseeker.campaigns.products.update',[$campaign, $product->id]) }}">

                    @method('PATCH')
                    @include('jobseeker.products.partials.form')

                </form>
            </div>
        </div>
    </div>
</div>
@endsection