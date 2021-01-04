@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card mt-4">
            @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{session('status')}}
                    </div>
                @endif
                <h3 class="mt-2 pd-2">You must verify your email address, please check your email for a verification link</h3>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    
                    <button type="submit" class="btn btn-primary mt-4">Resend Email</button>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
