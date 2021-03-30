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
                            <i data-feather="briefcase" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Occupation</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="current_job">Current Job</label>
                            <select name="current_job" id="current_job" class="form-control select2">
                                <option value="Agriculture">Agriculture</option>
                                <option value="Food and Natural Resources/Architecture">Food and Natural Resources/Architecture</option> 
                                <option value="Construction/Arts">Construction/Arts</option>
                                <option value="Audio/Video Technology">Audio/Video Technology</option>
                                <option value="Communications/Business Management">Communications/Business Management</option> 
                                <option value="Administration/Education">Administration/Education</option> 
                                <option value="Training/Finance/Government">Training/Finance/Government</option>
                                <option value="Public Administration/Health">Public Administration/Health</option> 
                                <option value="Science/Hospitality">Science/Hospitality</option>
                                <option value="Tourism/Human Services/Information Technology/Law">Tourism/Human Services/Information Technology/Law</option>
                                <option value="Public Safety">Public Safety</option>
                                <option value="Corrections and Security/Manufacturing/Marketing">Corrections and Security/Manufacturing/Marketing</option>
                                <option value="Sales and Service/Science">Sales and Service/Science</option>
                                <option value="Technology">Technology</option>
                                <option value="Engineering and Mathematics/Transportation">Engineering and Mathematics/Transportation</option>
                                <option value="Distribution and Logistics">Distribution and Logistics</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="employment_type">Employment Type</label>
                            <select name="employment_type" id="employment_type" class="form-control select2">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Commission">Commission</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="freq_of_work">Frequency of work</label>
                            <select name="freq_of_work" id="freq_of_work" class="form-control select2">
                                <option value="everyday">everyday</option>
                                <option value="5 days a week">5 days a week</option>
                                <option value="4 days a week">4 days a week</option> 
                                <option value="3 days a week">3 days a week</option> 
                                <option value="2 days a week">2 days a week</option> 
                                <option value="once a week">once a week</option>
                                <option value="once a month">once a month</option> 
                                <option value="occasional">occasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="main_source_income">Frequency of work</label>
                            <select name="main_source_income" id="main_source_income" class="form-control select2">
                                <option value="job">job</option>
                                <option value="part time jobs">part time jobs </option>
                                <option value="donations">donations</option> 
                                <option value="family">family</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="extra_source_income">Other Source of Income</label>
                            <select name="extra_source_income" id="extra_source_income" class="form-control select2">
                                <option value="part time jobs">part time jobs</option>
                                <option value="donations">donations</option>
                                <option value="family">family</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="skills">Skills</label>
                            <input type="text" name="skills" id="skills" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="work_exp">Work Experience</label>
                            <input type="text" name="work_exp" id="work_exp" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="daily_income">Daily Income</label>
                            <input type="text" name="daily_income" id="daily_income" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="daily_expenses">Daily Expenses</label>
                            <input type="text" name="daily_expenses" id="daily_expenses" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-1">
                            <i data-feather="shuffle" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Utility</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="type_of_housing">Type of Housing</label>
                            <select name="type_of_housing" id="type_of_housing" class="form-control select2">
                                <option value="Govnt. Housing">Govnt. Housing</option>
                                <option value="Apartment">Apartment</option>
                                <option value="Room">Room</option>
                                <option value="Bedspace">Bedspace</option>
                                <option value="Displaced/Homeless">Displaced/Homeless</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="form-group">
                            <label for="daily_meals">(Food) How many meals a day does your family eat in a day ? </label>
                            <select name="daily_meals" id="daily_meals" class="form-control select2">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Do you have access to water ?</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="wateraccess1" name="water_access" class="custom-control-input" value="Always" />
                                <label class="custom-control-label" for="wateraccess1">Always</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="wateraccess2" name="water_access" class="custom-control-input" value="Seldom"/>
                                <label class="custom-control-label" for="wateraccess2">Seldom</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="wateraccess3" name="water_access" class="custom-control-input" value="Never"/>
                                <label class="custom-control-label" for="wateraccess3">Never</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Do you have access to electricity ?</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="electricityaccess1" name="electricity_access" class="custom-control-input" value="Always" />
                                <label class="custom-control-label" for="electricityaccess1">Always</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="electricityaccess2" name="electricity_access" class="custom-control-input" value="Seldom"/>
                                <label class="custom-control-label" for="electricityaccess2">Seldom</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="electricityaccess3" name="electricity_access" class="custom-control-input" value="Never"/>
                                <label class="custom-control-label" for="electricityaccess3">Never</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Do you have access to clean clothes ?</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cleanclothesaccess1" name="clean_clothes_access" class="custom-control-input" value="Always" />
                                <label class="custom-control-label" for="cleanclothesaccess1">Always</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cleanclothesaccess2" name="clean_clothes_access" class="custom-control-input" value="Seldom"/>
                                <label class="custom-control-label" for="cleanclothesaccess2">Seldom</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cleanclothesaccess3" name="clean_clothes_access" class="custom-control-input" value="Never"/>
                                <label class="custom-control-label" for="cleanclothesaccess3">Never</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h4 class="mb-1">
                            <i data-feather="users" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Kids</span>
                        </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="kids-repeater">
                            <div data-repeater-list="kids">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kids_name">Name</label>
                                                <input type="text" class="form-control" id="kids_name"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="kids_age">Age</label>
                                                <input type="number" name="kids[age][]" class="form-control" id="kids_age"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-2 col-12 mb-50">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                    <i data-feather="x" class="mr-25"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span>Add New</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-12">
                        <h4 class="mb-1">
                            <i data-feather="users" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Dependents (Those you support financially)</span>
                        </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="dependents-repeater">
                            <div data-repeater-list="dependents">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dependent_name">Name</label>
                                                <input type="text" name="dependent[name][]" class="form-control" id="kids_name"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="dependent_age">Age</label>
                                                <input type="number" name="dependent[age][]" class="form-control" id="dependent_age"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dependent_relation">Relation</label>
                                                <select name="dependent[relation][]" id="dependent_relation" class="form-control select2">
                                                    <option value="Grandparents">Grandparents</option>
                                                    <option value="Parents">Parents</option>
                                                    <option value="Siblings">Siblings</option>
                                                    <option value="Nephew/Niece">Nephew/Niece</option>
                                                    <option value="Cousin">Cousin</option>
                                                    <option value="Boyfriend/Girlfriend">Boyfriend/Girlfriend</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-2 col-12 mb-50">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                    <i data-feather="x" class="mr-25"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span>Add New</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                 

                    <div class="col-12">
                        <h4 class="mb-1 mt-2">
                            <i data-feather="user" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">About Me</span>
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>    
@endsection

@section('external_js')
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/pages/app-js-myaccount.js') }}"></script>    
@endsection