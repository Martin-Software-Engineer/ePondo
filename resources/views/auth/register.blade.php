@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror    
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-control " id="password_confirmation" placeholder="Confirm Password">
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

                             
                                <div class="form-check">
                                <input class="form-check-input @error('role') is-invalid @enderror" type="radio" 
                                        name="role" id="{{$role->name}}" value="{{ $role->id }}"
                                        
                                        @isset($user) 
                                        @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset
                                        
                                >
                                
                                <label class="form-check-label" for="{{$role->name}}">
                                    {{ $role->name }}
                                </label>
                                </div>
                            

                            @error('role')
                            <span class="invalid-feedback" role="alert">Please select a role!!!!!</span>
                            @enderror

                        @endforeach
                        
                        
                    </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
