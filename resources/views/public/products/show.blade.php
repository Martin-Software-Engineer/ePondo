@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-3 mt-4">
            <h1>Product Name:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $product -> name}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-2 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $product -> description}}</p>
        </div>
    </div>

@endsection