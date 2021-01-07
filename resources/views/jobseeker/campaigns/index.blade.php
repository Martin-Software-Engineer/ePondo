@extends('layouts.app')

@section('content')
    <div class="row">
        <br><br><h1>Campaigns!</h1>
        <a class="btn btn-sm btn-success" href="{{ route('jobseeker.campaigns.create') }}" role="button">Create Campaign</a>
    </div>
@endsection