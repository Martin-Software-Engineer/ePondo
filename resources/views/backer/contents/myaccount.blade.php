@extends('backer.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('content')
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <form class="form-validate" action="{{route('backer.myaccount.update')}}" method="POST">
                @csrf 
                <div class="row mt-1">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input id="firstname" type="text" class="form-control" name="firstname" placeholder="Your First Name" value="{{$firstname}}" required/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Your Last Name" value="{{$lastname}}" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="phonenumber">Phone Number</label>
                            <input id="phonenumber" type="text" class="form-control" name="phone" value="{{$phone}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="emailaddress">Email Address</label>
                            <input id="emailaddress" type="email" class="form-control" name="email" value="{{$email}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{$address}}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input id="postcode" type="text" class="form-control" name="zipcode" value="{{$zipcode}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="cpassword">Current Password</label>
                            <input id="cpassword" type="password" class="form-control" name="current_password" required/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="newpassword">New Password</label>
                            <input id="newpassword" type="password" class="form-control" name="new_password" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="confirmpassword">Confirm New Password</label>
                            <input id="confirmpassword" type="password" class="form-control" name="new_confirm_password" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>    
@endsection

@section('scripts')
<script src="{{ asset('app-assets/js/scripts/pages/app-js-myaccount.js') }}"></script>    
@endsection