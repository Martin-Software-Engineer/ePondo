@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" aria-describedby="first_name" placeholder="Enter first_name" value="{{ old('first_name') }}">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" aria-describedby="last_name" placeholder="Enter last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Birth Date</label>
                        <input name="birth_date" type="text" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" aria-describedby="birth_date" placeholder="Enter birth_date" value="{{ old('birth_date') }}">
                        @error('birth_date')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror  
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input name="age" type="text" class="form-control @error('age') is-invalid @enderror" id="age" aria-describedby="age" placeholder="Enter age" value="{{ old('age') }}">
                        @error('age')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror  
                    </div>

                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <input name="sex" type="text" class="form-control @error('sex') is-invalid @enderror" id="sex" aria-describedby="sex" placeholder="Enter sex" value="{{ old('sex') }}">
                        @error('sex')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror  
                    </div>

                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <input name="marital_status" type="text" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status" aria-describedby="marital_status" placeholder="Enter marital_status" value="{{ old('marital_status') }}">
                        @error('marital_status')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror  
                    </div>

                    <div class="form-group">
                        <label for="kids">No. of Kids</label>
                        <input name="kids" type="text" class="form-control @error('kids') is-invalid @enderror" id="kids" aria-describedby="kids" placeholder="Enter kids" value="{{ old('kids') }}">
                        @error('kids')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror  
                    </div>
                
                    <div class="card mt-4 mb-4">
                        <div class="form-group">
                            <label for="kids">Address</label>
                                
                                <p>Address Line</p>
                                <input name="address_line" type="text" class="form-control @error('address_line') is-invalid @enderror" id="address_line" aria-describedby="address_line" placeholder="Enter address_line" value="{{ old('address_line') }}">
                                @error('address_line')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror                                           
                            
                        </div>

                        <div class="form-group">
                                <p>City</p>
                                <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" id="city" aria-describedby="city" placeholder="Enter city" value="{{ old('city') }}">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="from-group">
                                <p>State</p>
                                <input name="state" type="text" class="form-control @error('state') is-invalid @enderror" id="state" aria-describedby="state" placeholder="Enter state" value="{{ old('state') }}">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                                <p>Postal_code</p>
                                <input name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" aria-describedby="postal_code" placeholder="Enter postal_code" value="{{ old('postal_code') }}">
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="from-group">
                                <p>Country</p>
                                <input name="country" type="text" class="form-control @error('country') is-invalid @enderror" id="country" aria-describedby="country" placeholder="Enter country" value="{{ old('country') }}">
                                @error('country')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_no">Contact No.</label>
                            <input name="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" aria-describedby="contact_no" placeholder="Enter contact_no" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror  
                        </div>
                    </div>

                    <div class="card mt-4 mb-4">
                        <div class="form-group">
                            <label for="education">Eduation</label>
                            <input name="education" type="text" class="form-control @error('education') is-invalid @enderror" id="education" aria-describedby="education" placeholder="Enter education" value="{{ old('education') }}">
                            @error('education')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror  
                        </div>

                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input name="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" id="occupation" aria-describedby="occupation" placeholder="Enter occupation" value="{{ old('occupation') }}">
                            @error('occupation')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror  
                        </div>
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
                                <div class="form-check">
                                    <input class="form-check-input @error('role') is-invalid @enderror" name="role"
                                            type="checkbox" value="{{ $role->id }}" id="{{$role->name}}"
                                            @isset($user) 
                                            @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked 
                                            @endif 
                                            @endisset>
                                    <label class="form-check-label" for="{{$role->name}}">
                                        {{ $role->name }}
                                    </label>
                                </div>

                            @endforeach

                            @error('role')
                                <span class="invalid-feedback" role="alert">{{$message}}</span>
                            @enderror
                            
                            
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
</div>
@endsection
