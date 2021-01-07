@extends('layouts.app')

<!--
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card mt-4">-->

            @section('content')
    <div class="container">
    <br>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</div>
            <!--
            @if (session('status'))
            <div class="alert alert-danger mt-4" role="alert">
                {{ session('status') }}
            </div>
            @endif-->

            <div class="card-body">
                        @isset($url)
                            <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                                @else
                                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                        @endisset
                                        @csrf





               <!-- <h3 class="mt-2 pd-2">Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror    
                    </div>-->

                    <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-center">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}"  autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>




                    <!--<div class="form-group mt-2">
                        <label for="password">Password</label>-->

                        <div class="form-group row">
                                            <label for="password"
                                                   class="col-md-4 col-form-label text-md-center">{{ __('Password') }}</label>

                       <!-- <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        @error('password')  
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>-->

                    <div class="col-md-6">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       id="password" >

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                   <!-- <button type="submit" class="btn btn-primary mt-4">Login</button>-->
                   <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Login') }}
                                                </button>
                                                <a class="btn btn-link" href="forgot-password">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                </form>
                <div>
                   <!--<a href="forgot-password">Forgot Password ?</a>-->
                                                   
                                               
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection



