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

                <h5 class="mt-4">Please verify email address</h5>
                <p>We have sent you a verification link, please check your email inbox.<br>
                If you have not received any email from us. Please click the button below.</p>
                
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-1">Resend Email Verification Link</button>
                </form>
                
            </div>
            </div>
        </div>
    </div>

@endsection
