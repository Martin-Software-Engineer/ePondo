@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('content')
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <form class="form-validate">
                <div class="row mt-1">
                    <div class="col-12">
                        <h4 class="mb-1">
                            <i data-feather="user" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Personal Information</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="birth">Birth date</label>
                            <input id="birth" type="text" class="form-control birthdate-picker" name="dob" placeholder="YYYY-MM-DD" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input id="mobile" type="text" class="form-control" value="&#43;6595895857" name="phone" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input id="website" type="text" class="form-control" placeholder="Website here..." value="https://rowboat.com/insititious/Angelo" name="website" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="languages">Languages</label>
                            <select id="languages" class="form-control">
                                <option value="English">English</option>
                                <option value="Spanish">Spanish</option>
                                <option value="French" selected>French</option>
                                <option value="Russian">Russian</option>
                                <option value="German">German</option>
                                <option value="Arabic">Arabic</option>
                                <option value="Sanskrit">Sanskrit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Gender</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="male" name="gender" class="custom-control-input" />
                                <label class="custom-control-label" for="male">Male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="female" name="gender" class="custom-control-input" checked />
                                <label class="custom-control-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Contact Options</label>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="email-cb" checked />
                                <label class="custom-control-label" for="email-cb">Email</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="message" checked />
                                <label class="custom-control-label" for="message">Message</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="phone" />
                                <label class="custom-control-label" for="phone">Phone</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-1 mt-2">
                            <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Address</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="address-1">Address Line 1</label>
                            <input id="address-1" type="text" class="form-control" value="A-65, Belvedere Streets" name="address" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="address-2">Address Line 2</label>
                            <input id="address-2" type="text" class="form-control" placeholder="T-78, Groove Street" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input id="postcode" type="text" class="form-control" placeholder="597626" name="zip" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input id="city" type="text" class="form-control" value="New York" name="city" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="state">State</label>
                            <input id="state" type="text" class="form-control" name="state" placeholder="Manhattan" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input id="country" type="text" class="form-control" name="country" placeholder="United States" />
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
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