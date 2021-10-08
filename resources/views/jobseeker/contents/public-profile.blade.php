@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('content')
<section class="app-user-edit">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">My Public Profile</h4>
        </div>
        <div class="card-body">
            <form class="form-validate" id="form-profile" action="{{route('jobseeker.profile.update')}}">
                @csrf
                    
                <p class="j_prof_note"><strong>Note :</strong> 
                    The public profile is not required. But highly encouraged in order to provide your backers/customers 
                    additional information about you. This is important for campaigns so that backers are able to connect
                    with you through your life story and this can touch their hearts to support your campaigns. For services
                    this becomes important as it will contain information such us skills and work experience that can be vital
                    to attract your customers to avail your services. You may review ePondo's Data Privacy Policy <a href="{{route('privacypolicy')}}" style="font-weight:400;">here</a>. If you have
                    any additional quesitons you can contact us through epondo.co@gmail.com.
                </p>

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
                            <span class="j_tag_trans">(Kasalukuyang Trabaho)</span>
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
                            <span class="j_tag_trans">(Kategorya ng Trabaho)</span>
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
                            <span class="j_tag_trans">(Prikwensiya ng Trabaho)</span>
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
                    <div class="col-12">
                        <h4 class="mb-1">
                            <hr>
                            <i data-feather="heart" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Living State</span>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="main_source_income">Main source of income</label>
                            <span class="j_tag_trans"><br>(Pangunahing pinagkukunan ng inggreso/kita)</span>
                            <select name="main_source_income" id="main_source_income" class="form-control select2">
                                <option value="job" @if($info->main_source_income=='Job') selected @endif>Job</option>
                                <option value="part time jobs" @if($info->main_source_income=='Part Time Jobs') selected @endif>Part Time Jobs </option>
                                <option value="donations" @if($info->main_source_income=='Donations') selected @endif>Donations</option>
                                <option value="family" @if($info->main_source_income=='Family') selected @endif>Family</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="extra_source_income">Other Source of Income</label>
                            <span class="j_tag_trans"><br>(Pangalawang pinagkukunan ng inggreso/kita)</span>
                            <select name="extra_source_income" id="extra_source_income" class="form-control select2">
                                <option value="none" @if($info->main_source_income=='None') selected @endif>None</option>
                                <option value="part time jobs" @if($info->extra_source_income=='Part Time Jobs') selected @endif>Part Time Jobs </option>
                                <option value="donations" @if($info->extra_source_income=='Donations') selected @endif>Donations</option>
                                <option value="family" @if($info->extra_source_income=='Family') selected @endif>Family</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="daily_income">Average Daily Income</label>
                            <span class="j_tag_trans"><br>(Karaniwang inggreso/kita sa isang araw)</span>
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
                            <label for="daily_expenses">Average Daily Expenses</label>
                            <span class="j_tag_trans"><br>(Karaniwang kabuuang gastos sa isang araw)</span>
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
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label for="type_of_housing">Type of Housing</label>
                            <span class="j_tag_trans"><br>(Uri ng pamamahay)</span>
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
                    <div class="col-lg-4 col-md-9">
                        <div class="form-group">
                            <label for="daily_meals">How many meals does your family eat in a day?</label>
                            <span class="j_tag_trans"><br>(Ilang beses nakakakain ang pamilya mo sa isang araw ?)</span>
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
                            <label class="d-block ">Do you have access to clean water ?</label>
                            <span class="j_tag_trans">(Nakakagamit ba kayo ng malinis na tubig ?)</span>
                            <select name="water_access" id="water_access" class="form-control select2">
                                <option value="Always" @if($info->water_access == 1) selected @endif>Always</option>
                                <option value="Seldom" @if($info->water_access == 2) selected @endif>Seldom</option>
                                <option value="Never" @if($info->water_access == 5) selected @endif>Never</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block ">Do you have access to electricity ?</label>
                            <span class="j_tag_trans">(Nakakagamit ba kayo ng kuryente ?)</span>
                            <select name="electricity_access" id="electricity_access" class="form-control select2">
                                <option value="Always" @if($info->electricity_access == 1) selected @endif>Always</option>
                                <option value="Seldom" @if($info->electricity_access == 2) selected @endif>Seldom</option>
                                <option value="Never" @if($info->electricity_access == 5) selected @endif>Never</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label class="d-block">Do you have access to clean clothes ?</label>
                            <span class="j_tag_trans">(Nakakasuot ba kayo ng malinis na damit ?)</span>
                            <select name="clean_clothes_access" id="clean_clothes_access" class="form-control select2">
                                <option value="Always" @if($info->clean_clothes_access == 1) selected @endif>Always</option>
                                <option value="Seldom" @if($info->clean_clothes_access == 2) selected @endif>Seldom</option>
                                <option value="Never" @if($info->clean_clothes_access == 5) selected @endif>Never</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <h4 class="mb-1">
                            <hr>
                            <i data-feather="users" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Kids</span>
                            <span class="j_tag_trans">(Anak)</span>
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
                                                <span class="j_tag_trans">(Pangalan)</span>
                                                <input type="text" name="kids[name][]" class="form-control" value="{{$kid->fullname}}" id="kids[name][]"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="kids_age">Age</label>
                                                <span class="j_tag_trans">(Edad)</span>
                                                <input type="number" name="kids[age][]" class="form-control" value="{{$kid->age}}" id="kids[name][]"/>
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
                            <hr>
                            <i data-feather="users" class="font-medium-4 mr-25"></i>
                            <span class="align-center">Dependents</span>
                            <span class="align-middle ml-1" style="color:gray;font-weight:normal;font-size:10px;">Individuals that you financially support</span>
                            <span style="color:gray;font-weight:lighter;font-style:italic;font-size:10px; ">(Mga Indibidwal na iyong sinusustentuhan/sinusuportahan)</span>
                        </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="dependents-repeater">
                            <div data-repeater-list="dependents">
                                @forelse($dependents as $dependent)
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="dependent_name">Name</label>
                                                <span class="j_tag_trans">(Pangalan)</span>
                                                <input type="text" name="dependents[name][]" class="form-control" value="{{$dependent->fullname}}" id="dependent_name"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="dependent_age">Age</label>
                                                <span class="j_tag_trans">(Edad)</span>
                                                <input type="number" name="dependents[age][]" class="form-control" value="{{$dependent->age}}" id="dependent_age"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="dependent_relation">Relation</label>
                                                <span class="j_tag_trans">(Relasyon)</span>
                                                <select name="dependents[relation][]" id="dependent_relation" class="form-control select2">
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
                                </div>
                                @empty
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dependent_name">Name</label>
                                                <input type="text" name="dependents[name][]" class="form-control" id="kids_name"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="dependent_age">Age</label>
                                                <input type="number" name="dependents[age][]" class="form-control" id="dependent_age"/>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="dependent_relation">Relation</label>
                                                <select name="dependents[relation][]" id="dependent_relation" class="form-control select2">
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
                            <hr>
                            <i data-feather="tool" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Skills</span>
                            <span class="j_tag_trans">(Kasanayan/Kakayahan)</span>
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
                            <hr>
                            <i data-feather="briefcase" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">Work Experiences</span>
                            <span class="j_tag_trans">(Karanasahan sa trabaho)</span>
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
                                                <span class="j_tag_trans">(Kompanya)</span>
                                                <input type="text" name="workexp[company][]" class="form-control" value="{{$workexp->company}}" id="company"/>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="description">Position</label>
                                                <span class="j_tag_trans">(Posisyon)</span>
                                                <input type="text" name="workexp[description][]" class="form-control" value="{{$workexp->description}}" id="description"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="year">Period</label>
                                                <span class="j_tag_trans">(Panahon)</span>
                                                <input type="text" name="workexp[year][]" class="form-control" value="{{$workexp->year}}" id="year"/ placeholder="YYYY-YYYY">
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
                                </div>
                                @empty
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="company">Company</label>
                                                <span class="j_tag_trans">(Kompanya)</span>
                                                <input type="text" name="workexp[company][]" class="form-control" id="company"/>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="description">Position</label>
                                                <span class="j_tag_trans">(Posisyon)</span>
                                                <input type="text" name="workexp[description][]" class="form-control" id="description"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="form-group">
                                                <label for="year">Period</label>
                                                <span class="j_tag_trans">(Panahon)</span>
                                                <input type="text" name="workexp[year][]" class="form-control" id="year"/ placeholder="YYYY-YYYY">
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
                            <hr>
                            <i data-feather="edit-3" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">About Me</span>
                            <span class="j_tag_trans">(Karagdagang impormasyo tungkil sa iyo)</span>
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="bio" id="bio" cols="30" rows="15" class="form-control">{{$info->bio}}</textarea>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-success mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="form-validate" id="form-profile-pppp" action="{{route('jobseeker.profile.updatepppp')}}" method="POST">
                @csrf
                <div class="row">
                
                <div class="col-12">
                        <h4 class="mb-1">
                            <i data-feather="edit-3" class="font-medium-4 mr-25"></i>
                            <span class="align-middle">4Ps Information (Pantawid Pamilyang Pilipino Program)</span>
                        </h4>
                        <p class="j_prof_note mb-1"><strong>Note :</strong> 
                            Optional. If you are a 4Ps beneficiary please fill in the following information below .You may review ePondo's Data Privacy Policy <a href="{{route('privacypolicy')}}" style="font-weight:400;">here</a>. If you have
                            any additional quesitons you can contact us through epondo.co@gmail.com.
                        </p>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="4psId">Upload proof of 4Ps beneficiary (ID, or any proof)</label>
                            <input type="file" name="4psId" class="form-control" id="4psId"/>
                        </div>

                        @if(@$pppp->id_photo != '')
                            <img src="{{Storage::url(@$pppp->photo->url)}}" alt="" width="200">
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question1">How did you acquired for 4Ps?</label>
                            <input type="text" name="question1" class="form-control" id="question1" value="{{@$pppp->question1}}"/>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question2">How long have you been a 4Ps beneficiary?</label>
                            <select name="question2" id="question2" class="form-control">
                                <option value="less than a year" @if(@$pppp->question2 == 'less than a year') selected @endif>less than a year</option>
                                <option value="1 year" @if(@$pppp->question2 == '1 year') selected @endif>1 year</option>
                                <option value="2 years" @if(@$pppp->question2 == '2 years') selected @endif>2 years</option>
                                <option value="3 years" @if(@$pppp->question2 == '3 years') selected @endif>3 years</option>
                                <option value="4 years and above" @if(@$pppp->question2 == '4 years and above') selected @endif>4 years and above</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question3">How is your experience?</label>
                            <select name="question3" id="question3" class="form-control">
                                <option value="Very Good" @if(@$pppp->question3 == 'Very Good') selected @endif>Very Good</option>
                                <option value="Good" @if(@$pppp->question3 == 'Good') selected @endif>Good</option>
                                <option value="Bad" @if(@$pppp->question3 == 'Bad') selected @endif>Bad</option>
                                <option value="Very Bad" @if(@$pppp->question3 == 'Very Bad') selected @endif>Very Bad</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question4">Why? (Indicate reason for your answer above)</label>
                            <textarea name="question4" id="question4" cols="30" rows="15" class="form-control">{{@$pppp->question4}}</textarea>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-success mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
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

            var formProfile = $('#form-profile'),
                formPPPP = $('#form-profile-pppp')

            formProfile.on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            setTimeout(function(){
                                location.reload()
                            }), 200;
                        }
                    },
                    error: function(xhr, status, error){
                        $.each(xhr.responseJSON.errors, function(key, text) {
                            toastr['error'](text[0], 'Error!', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        });
                    }
                });
            });
            formPPPP.on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            setTimeout(function(){
                                location.reload()
                            }), 200;
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
