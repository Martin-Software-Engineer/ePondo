@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card mt-4">
                <h3 class="mt-2 pd-2">Reset Password</h3>

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{session('status')}}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror    
                    </div>
                    <input name="reset" id="reset" class="btn btn-primary login-btn mt-4" type="submit" value="Reset">
                    
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
