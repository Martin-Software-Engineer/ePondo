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
            <form class="form-validate" id="form-profile" action="{{route('jobseeker.profile.update')}}">
                @csrf
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
                                <option value="Agriculture" @if($info->current_job == 'Agriculture') selected @endif>Agriculture</option>
                                <option value="Food and Natural Resources/Architecture" @if($info->current_job == 'Food and Natural Resources/Architecture') selected @endif>Food and Natural Resources/Architecture</option> 
                                <option value="Construction/Arts" @if($info->current_job == 'Construction/Arts') selected @endif>Construction/Arts</option>
                                <option value="Audio/Video Technology" @if($info->current_job == 'Audio/Video Technology') selected @endif>Audio/Video Technology</option>
                                <option value="Communications/Business Management" @if($info->current_job == 'Communications/Business Management') selected @endif>Communications/Business Management</option> 
                                <option value="Administration/Education" @if($info->current_job == 'Administration/Education') selected @endif>Administration/Education</option> 
                                <option value="Training/Finance/Government" @if($info->current_job == 'Training/Finance/Government') selected @endif>Training/Finance/Government</option>
                                <option value="Public Administration/Health" @if($info->current_job == 'Public Administration/Health') selected @endif>Public Administration/Health</option> 
                                <option value="Science/Hospitality" @if($info->current_job == 'Science/Hospitality') selected @endif>Science/Hospitality</option>
                                <option value="Tourism/Human Services/Information Technology/Law" @if($info->current_job == 'Tourism/Human Services/Information Technology/Law') selected @endif>Tourism/Human Services/Information Technology/Law</option>
                                <option value="Public Safety" @if($info->current_job == 'Public Safety') selected @endif>Public Safety</option>
                                <option value="Corrections and Security/Manufacturing/Marketing" @if($info->current_job == 'Corrections and Security/Manufacturing/Marketing') selected @endif>Corrections and Security/Manufacturing/Marketing</option>
                                <option value="Sales and Service/Science" @if($info->current_job == 'Sales and Service/Science') selected @endif>Sales and Service/Science</option>
                                <option value="Technology" @if($info->current_job == 'Technology') selected @endif>Technology</option>
                                <option value="Engineering and Mathematics/Transportation" @if($info->current_job == 'Engineering and Mathematics/Transportation') selected @endif>Engineering and Mathematics/Transportation</option>
                                <option value="Distribution and Logistics" @if($info->current_job == 'Distribution and Logistics') selected @endif>Distribution and Logistics</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="employment_type">Employment Type</label>
                            <select name="employment_type" id="employment_type" class="form-control select2">
                                <option value="Full Time" @if($info->employment_type == 'Full Time') selected @endif>Full Time</option>
                                <option value="Part Time" @if($info->employment_type == 'Part Time') selected @endif>Part Time</option>
                                <option value="Commission" @if($info->employment_type == 'Commission') selected @endif>Commission</option>
                                <option value="Unemployed" @if($info->employment_type == 'Unemployed') selected @endif>Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="freq_of_work">Frequency of work</label>
                            <select name="freq_of_work" id="freq_of_work" class="form-control select2">
                                <option value="everyday" @if($info->freq_of_work=='everyday') selected @endif>everyday</option>
                                <option value="5 days a week" @if($info->freq_of_work=='5 days a week') selected @endif>5 days a week</option>
                                <option value="4 days a week" @if($info->freq_of_work=='4 days a week') selected @endif>4 days a week</option> 
                                <option value="3 days a week" @if($info->freq_of_work=='3 days a week') selected @endif>3 days a week</option> 
                                <option value="2 days a week" @if($info->freq_of_work=='2 days a week') selected @endif>2 days a week</option> 
                                <option value="once a week" @if($info->freq_of_work=='once a week') selected @endif>once a week</option>
                                <option value="once a month" @if($info->freq_of_work=='once a month') selected @endif>once a month</option> 
                                <option value="occasional" @if($info->freq_of_work=='occasional') selected @endif>occasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="main_source_income">Main source of income</label>
                            <select name="main_source_income" id="main_source_income" class="form-control select2">
                                <option value="job" @if($info->main_source_income=='job') selected @endif>job</option>
                                <option value="part time jobs" @if($info->main_source_income=='part time jobs') selected @endif>part time jobs </option>
                                <option value="donations" @if($info->main_source_income=='donations') selected @endif>donations</option> 
                                <option value="family" @if($info->main_source_income=='family') selected @endif>family</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="extra_source_income">Other Source of Income</label>
                            <select name="extra_source_income" id="extra_source_income" class="form-control select2">
                                <option value="none" @if($info->main_source_income=='none') selected @endif>none</option>
                                <option value="part time jobs" @if($info->extra_source_income=='part time jobs') selected @endif>part time jobs </option>
                                <option value="donations" @if($info->extra_source_income=='donations') selected @endif>donations</option> 
                                <option value="family" @if($info->extra_source_income=='family') selected @endif>family</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="daily_income">Daily Income</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" name="daily_income" step=".01" id="daily_income" class="form-control" value="{{$info->daily_income}}" placeholder="00" aria-label="Amount (to the nearest peso)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="daily_expenses">Daily Expenses</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" name="daily_expenses" step=".01" id="daily_expenses" class="form-control" value="{{$info->daily_expenses}}" placeholder="00" aria-label="Amount (to the nearest peso)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-1">
                            <i data-feather="shuffle" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Living State</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="type_of_housing">Type of Housing</label>
                            <select name="type_of_housing" id="type_of_housing" class="form-control select2">
                                <option value="Govnt. Housing" @if($info->type_of_housing == 'Govnt. Housing') selected @endif>Govnt. Housing</option>
                                <option value="Apartment" @if($info->type_of_housing == 'Apartment') selected @endif>Apartment</option>
                                <option value="Room" @if($info->type_of_housing == 'Room') selected @endif>Room</option>
                                <option value="Bedspace" @if($info->type_of_housing == 'Bedspace') selected @endif>Bedspace</option>
                                <option value="Displaced/Homeless" @if($info->type_of_housing == 'Displaced/Homeless') selected @endif>Displaced/Homeless</option>
                                <option value="Others" @if($info->type_of_housing == 'Others') selected @endif>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="form-group">
                            <label for="daily_meals">How many meals do you or your family get to eat in a day?</label>
                            <select name="daily_meals" id="daily_meals" class="form-control select2">
                                <option value="1" @if($info->daily_meals == 1) selected @endif>1</option>
                                <option value="2" @if($info->daily_meals == 2) selected @endif>2</option>
                                <option value="3" @if($info->daily_meals == 3) selected @endif>3</option>
                                <option value="4" @if($info->daily_meals == 4) selected @endif>4</option>
                                <option value="5" @if($info->daily_meals == 5) selected @endif>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Do you have access to water ?</label>
                            <select name="water_access" id="water_access" class="form-control select2">
                                <option value="Always" @if($info->water_access == 1) selected @endif>Always</option>
                                <option value="Seldom" @if($info->water_access == 2) selected @endif>Seldom</option>
                                <option value="Never" @if($info->water_access == 5) selected @endif>Never</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Do you have access to electricity ?</label>
                            <select name="electricity_access" id="electricity_access" class="form-control select2">
                                <option value="Always" @if($info->electricity_access == 1) selected @endif>Always</option>
                                <option value="Seldom" @if($info->electricity_access == 2) selected @endif>Seldom</option>
                                <option value="Never" @if($info->electricity_access == 5) selected @endif>Never</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block mb-1">Do you have access to clean clothes ?</label>
                            <select name="clean_clothes_access" id="clean_clothes_access" class="form-control select2">
                                <option value="Always" @if($info->clean_clothes_access == 1) selected @endif>Always</option>
                                <option value="Seldom" @if($info->clean_clothes_access == 2) selected @endif>Seldom</option>
                                <option value="Never" @if($info->clean_clothes_access == 5) selected @endif>Never</option>
                            </select>
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
                                @forelse($kids as $kid)
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kids_name">Name</label>
                                                <input type="text" name="kids[name][]" class="form-control" value="{{$kid->fullname}}" id="kids_name"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="kids_age">Age</label>
                                                <input type="number" name="kids[age][]" class="form-control" value="{{$kid->age}}" id="kids_age"/>
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
                                @empty 
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kids_name">Name</label>
                                                <input type="text" name="kids[name][]" class="form-control" id="kids_name"/>
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
                                @endforelse
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
                                @forelse($dependents as $dependent)
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dependent_name">Name</label>
                                                <input type="text" name="dependent[name][]" class="form-control" value="{{$dependent->fullname}}" id="dependent_name"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="dependent_age">Age</label>
                                                <input type="number" name="dependent[age][]" class="form-control" value="{{$dependent->age}}" id="dependent_age"/>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dependent_relation">Relation</label>
                                                <select name="dependent[relation][]" id="dependent_relation" class="form-control select2">
                                                    <option value="Grandparents" @if($dependent->relation == 'Gradparents') selected @endif>Grandparents</option>
                                                    <option value="Parents" @if($dependent->relation == 'Parents') selected @endif>Parents</option>
                                                    <option value="Siblings" @if($dependent->relation == 'Siblings') selected @endif>Siblings</option>
                                                    <option value="Nephew/Niece" @if($dependent->relation == 'Nephew/Niece') selected @endif>Nephew/Niece</option>
                                                    <option value="Cousin" @if($dependent->relation == 'Cousin') selected @endif>Cousin</option>
                                                    <option value="Boyfriend/Girlfriend" @if($dependent->relation == 'Boyfriend/Girlfriend') selected @endif>Boyfriend/Girlfriend</option>
                                                    <option value="Others" @if($dependent->relation == 'Others') selected @endif>Others</option>
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
                                @empty 
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
                                @endforelse
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
                            <span class="align-middle">Skills</span>
                        </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="skills-repeater">
                            <div data-repeater-list="skills">
                                @forelse($skills as $skill)
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-10 col-12">
                                            <div class="form-group">
                                                <label for="skills">Skill</label>
                                                <input type="text" name="skills[name][]" class="form-control" value="{{$skill->work_skill}}" id="skills"/>
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
                                @empty 
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-10 col-12">
                                            <div class="form-group">
                                                <label for="skills">Skill</label>
                                                <input type="text" name="skills[name][]" class="form-control" id="skills"/>
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
                                @endforelse
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
                            <span class="align-middle">Work Experiences</span>
                        </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="work-experiences-repeater">
                            <div data-repeater-list="workexp">
                                @forelse($workexperiences as $workexp)
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="company">Company</label>
                                                <input type="text" name="workexp[company][]" class="form-control" value="{{$workexp->company}}" id="company"/>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="workexp[description][]" class="form-control" value="{{$workexp->description}}" id="description"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <input type="text" name="workexp[year][]" class="form-control" value="{{$workexp->year}}" id="year"/>
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
                                @empty 
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="company">Company</label>
                                                <input type="text" name="workexp[company][]" class="form-control" id="company"/>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="workexp[description][]" class="form-control" id="description"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <input type="text" name="workexp[year][]" class="form-control" id="year"/>
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
                                @endforelse
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
                            <textarea name="bio" id="bio" cols="30" rows="10" class="form-control">{{$info->bio}}</textarea>
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
    <script>
        $(function($){
            'use strict';
            
            var form = $('#form-profile');

            form.on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            });

            $('.kids-repeater, .dependents-repeater, .skills-repeater, .work-experiences-repeater').repeater({
                show: function() {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({ width: 14, height: 14 });
                    }
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>    
@endsection