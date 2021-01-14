@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-4 mt-4">
            <h1>Product Name:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $product -> name}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $product -> description}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Product Category:</h4>
        </div>
        
        <div class="col mt-4">
            
            <p>#</p>
            
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign}}/products/{{$product->id}}/edit" role="button">Edit Product Details</a>
            </div>
        </div>
    </div>

@endsection
