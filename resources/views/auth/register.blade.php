@extends('layouts.auth')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-wizard.css')}}">
@endsection

@section('content')
<h4 class="card-title mb-1 text-center">Sign Up Here!</h4>

<form class="auth-register-form mt-2" action="{{route('register')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="username" class="form-label">Username(Alias)</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" placeholder="johndoe" aria-describedby="register-username" tabindex="1" autofocus />
        <small>You can use this to login incase you forgot your email</small>
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2" />
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>

        <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
            <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
        </div>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="cpassword" class="form-label">Confirm Password</label>

        <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="cpassword" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-cpassword" tabindex="4" />
            <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
        </div>

        @error('confirmed')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" id="firstname" name="firstname" tabindex="5" autofocus />
        @error('firstname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" id="lastname" name="lastname" tabindex="6" autofocus />
        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="role" class="form-label">Register as </label>

        <select name="role" id="role" class="form-control">
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>

        @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="register-privacy-policy" tabindex="7" required/>
            <label class="custom-control-label" for="register-privacy-policy">
                I agree to <a href="javascript:void(0);">privacy policy & terms</a>
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" tabindex="8">Sign up</button>

</form>
<p class="text-center mt-2">
    <span>Already have an account?</span>
    <a href="{{route('login')}}">
        <span>Sign in instead</span>
    </a>
</p>
@endsection

@section('page_js')
<script src="{{asset('/app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection
@section('js')
<script src="{{asset('/app-assets/js/scripts/forms/form-wizard.js')}}"></script>
<script src="{{asset('/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
@endsection