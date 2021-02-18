@extends('layouts.auth')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-wizard.css')}}">
@endsection

@section('content')
<h4 class="card-title mb-1 text-center">Welcome! 👋</h4>
<p class="card-text mb-2 text-center">Sign in to ePondo</p>

<form class="auth-register-form mt-2" action="{{route('register')}}" method="POST">
    @csrf
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#account-details">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">1</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Name</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#personal-info">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Contact</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#address-step">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">3</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Birthday</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">4</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Account</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">5</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Submit</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="account-details" class="content">
                    <div class="content-header">
                        <h5 class="mb-0">Account Details</h5>
                        <small class="text-muted">Enter Your Account Details.</small>
                    </div>
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="johndoe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" disabled>
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>
                </div>
                <div id="personal-info" class="content">
                    <div class="content-header">
                        <h5 class="mb-0">Personal Info</h5>
                        <small>Enter Your Personal Info.</small>
                    </div>
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="first-name">First Name</label>
                                <input type="text" name="first-name" id="first-name" class="form-control" placeholder="John" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="last-name">Last Name</label>
                                <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="country">Country</label>
                                <select class="select2 w-100" name="country" id="country">
                                    <option label=" "></option>
                                    <option>UK</option>
                                    <option>USA</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Italy</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="language">Language</label>
                                <select class="select2 w-100" name="language" id="language" multiple>
                                    <option>English</option>
                                    <option>French</option>
                                    <option>Spanish</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>
                </div>
                <div id="address-step" class="content">
                    <div class="content-header">
                        <h5 class="mb-0">Address</h5>
                        <small>Enter Your Address.</small>
                    </div>
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="98  Borough bridge Road, Birmingham" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="landmark">Landmark</label>
                                <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Borough bridge" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode1">Pincode</label>
                                <input type="text" id="pincode1" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city1">City</label>
                                <input type="text" id="city1" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                        </button>
                    </div>
                </div>
                <div id="social-links" class="content">
                    <div class="content-header">
                        <h5 class="mb-0">Social Links</h5>
                        <small>Enter Your Social Links.</small>
                    </div>
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="twitter">Twitter</label>
                                <input type="text" id="twitter" name="twitter" class="form-control" placeholder="https://twitter.com/abc" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="facebook">Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-control" placeholder="https://facebook.com/abc" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="google">Google+</label>
                                <input type="text" id="google" name="google" class="form-control" placeholder="https://plus.google.com/abc" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="linkedin">Linkedin</label>
                                <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-prev">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-success btn-submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
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