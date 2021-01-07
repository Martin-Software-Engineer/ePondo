@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card mt-4">

            @if (session('status'))
            <div class="alert alert-danger mt-4" role="alert">
                {{ session('status') }}
            </div>
            @endif

                <h3 class="mt-2 pd-2">Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror    
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Login</button>
                </form>
                <div>
                    <a href="forgot-password">Forgot Password ?</a>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection
