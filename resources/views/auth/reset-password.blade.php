@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card mt-4">
                <h3 class="mt-2 pd-2">Reset Password</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{$request->route('token')}}">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ $request->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror    
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="password">New Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="New Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input name="password_confirmation" type="password" class="form-control " id="password_confirmation" placeholder="Confirm Password">
                </div>
                    <input name="reset" id="reset" class="btn btn-primary login-btn mt-4 " type="submit" value="Update">
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
