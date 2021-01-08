@extends('layouts.app')

<!--
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Register</h1>
            <form method="POST" action="{{ route('register') }}">-->
            @section('content')
<div class="container">
<br>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</div>
                <!--
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror-->

                    <div class="card-body">
                    @isset($url)
                        <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                            @else
                                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                    @endisset
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-center">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') 
                                is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                               
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                    <br>

                <!--<div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror    
                </div>-->

                <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                <!--<div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>-->
                <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <br>


                <!--<div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-control " id="password_confirmation" placeholder="Confirm Password">
                </div>-->


                <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-center">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                <div class="mb-3">
                        @foreach($roles as $role)
                            <!-- <div class="form-check">
                                <input class="form-check-input @error('role') is-invalid @enderror" name="role"
                                        type="checkbox" value="{{ $role->id }}" id="{{$role->name}}"
                                        @isset($user) 
                                        @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset>
                                <label class="form-check-label" for="{{$role->name}}">
                                    {{ $role->name }}
                                </label>
                            </div> -->

                             
                               <!-- <div class="form-check @error('role') is-invalid @enderror">
                                <input class="form-check-input @error('role') is-invalid @enderror" type="radio" 
                                        name="role" id="{{$role->name}}" value="{{ $role->id }}"
                                        
                                        @isset($user) 
                                        @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset
                                        
                                
                                
                                <label class="form-check-label" for="{{$role->name}}">
                                    {{ $role->name }}
                                </label>
                                </div>
                            
                        @endforeach

                        @error('role')
                            <span class="invalid-feedback" role="alert">{{$message}}</span>
                        @enderror-->
                        
                        
                    </div>

                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
</div>
@endsection
