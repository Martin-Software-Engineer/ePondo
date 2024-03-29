@extends('layouts.auth')

@section('content')
<h2 class="mb-1 text-center">Welcome!</h2>
<p class="card-text mb-2 text-center">Log-In to ePondo</p>
    @if(session('status'))
    <div class="w-100 text-center">
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
    </div>
    @endif
<form class="auth-login-form mt-2" action="{{route('login')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="login-email" class="form-label">Email</label>
        <input type="text" class="form-control" id="login-email" name="email" value="{{ old('email') }}" autocomplete="login-email" tabindex="1" autofocus >
        @error('email')
            <span id="login-email-error" class="error">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="login-password">Password</label>
            <a href="{{route('password.request')}}">
                <small>Forgot Password?</small>
            </a>
        </div>
        <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
            <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password')
                <span id="login-password-error" class="error">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="remember_me" value="1" id="remember-me" tabindex="3" />
            <label class="custom-control-label" for="remember-me"> Remember Me </label>
        </div>
    </div>
    <!-- <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button> -->
    <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
</form>
<p class="text-center mt-2">
    <span>New in ePondo / No Account ?</span>
    <a href="{{route('register')}}">
        <strong>Sign-Up</strong>
    </a>
</p>
@endsection

@section('js')
    
    <!-- BEGIN: Page JS-->
    <script src="{{asset('/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
    <!-- END: Page JS-->

@endsection