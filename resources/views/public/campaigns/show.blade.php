@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-3 mt-4">
            <h1>Campaign Title:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $campaign -> title}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-2 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $campaign -> description}}</p>
        </div>
    </div>

    <div class="row">
        <h1>Jobs</h1>
    </div>

@endsection