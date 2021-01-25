@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Background Information</h1>
            <div class="card">

                <form method="POST" action="{{ route('jobseeker.background.store') }}" enctype="multipart/form-data">
                    
                    @csrf

                    <!-- Dont forget to edit all isset($campaign) -->
                        <div class="form-group">
                        <label for="job">Job</label>
                        <input name="job" type="text" class="form-control @error('job') is-invalid @enderror" id="job" aria-describedby="job" placeholder="Enter job" 
                                value="{{ old('job') }} @isset($campaign) {{ $campaign->job }} @endisset">
                        @error('job')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="employment_type">Employment Type</label>
                        <input name="employment_type" type="text" class="form-control @error('employment_type') is-invalid @enderror" id="employment_type" aria-describedby="employment_type" placeholder="Enter employment_type" 
                                value="{{ old('employment_type') }} @isset($campaign) {{ $campaign->employment_type }} @endisset">
                        @error('employment_type')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="frequency">Frequency (How often do you get to work ?)</label>
                        <input name="frequency" type="text" class="form-control @error('frequency') is-invalid @enderror" id="frequency" aria-describedby="frequency" placeholder="Enter frequency" 
                                value="{{ old('frequency') }} @isset($campaign) {{ $campaign->frequency }} @endisset">
                        @error('frequency')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="main_source_of_income">Main Source of Income</label>
                        <input name="main_source_of_income" type="text" class="form-control @error('main_source_of_income') is-invalid @enderror" id="main_source_of_income" aria-describedby="main_source_of_income" placeholder="Enter main_source_of_income" 
                                value="{{ old('main_source_of_income') }} @isset($campaign) {{ $campaign->main_source_of_income }} @endisset">
                        @error('main_source_of_income')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="other_sources_of_income">Other Source/s of Income</label>
                        <input name="other_sources_of_income" type="text" class="form-control @error('other_sources_of_income') is-invalid @enderror" id="other_sources_of_income" aria-describedby="other_sources_of_income" placeholder="Enter other_sources_of_income" 
                                value="{{ old('other_sources_of_income') }} @isset($campaign) {{ $campaign->other_sources_of_income }} @endisset">
                        @error('other_sources_of_income')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="daily_income">Average Daily Income</label>
                        <input name="daily_income" type="text" class="form-control @error('daily_income') is-invalid @enderror" id="daily_income" aria-describedby="daily_income" placeholder="Enter daily_income" 
                                value="{{ old('daily_income') }} @isset($campaign) {{ $campaign->daily_income }} @endisset">
                        @error('daily_income')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="daily_expenses">Average Daily Expenses</label>
                        <input name="daily_expenses" type="text" class="form-control @error('daily_expenses') is-invalid @enderror" id="daily_expenses" aria-describedby="daily_expenses" placeholder="Enter daily_expenses" 
                                value="{{ old('daily_expenses') }} @isset($campaign) {{ $campaign->daily_expenses }} @endisset">
                        @error('daily_expenses')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="expenses">Expenses (What are your expenses ?)</label>
                        <input name="expenses" type="text" class="form-control @error('expenses') is-invalid @enderror" id="expenses" aria-describedby="expenses" placeholder="Enter expenses" 
                                value="{{ old('expenses') }} @isset($campaign) {{ $campaign->expenses }} @endisset">
                        @error('expenses')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="housing">Housing (House, Condo, Room etc.)</label>
                        <input name="housing" type="text" class="form-control @error('housing') is-invalid @enderror" id="housing" aria-describedby="housing" placeholder="Enter housing" 
                                value="{{ old('housing') }} @isset($campaign) {{ $campaign->housing }} @endisset">
                        @error('housing')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>
                        
                        <div class="form-group">
                        <label for="meals_day">Meals a day (How many meals do you eat in a day ?)</label>
                        <input name="meals_day" type="text" class="form-control @error('meals_day') is-invalid @enderror" id="meals_day" aria-describedby="meals_day" placeholder="Enter meals_day" 
                                value="{{ old('meals_day') }} @isset($campaign) {{ $campaign->meals_day }} @endisset">
                        @error('meals_day')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>
                        
                        <div class="form-group">
                        <label for="access_water">Access to clean water (Accessible/ Not Accessible ?)</label>
                        <input name="access_water" type="text" class="form-control @error('access_water') is-invalid @enderror" id="access_water" aria-describedby="access_water" placeholder="Enter access_water" 
                                value="{{ old('access_water') }} @isset($campaign) {{ $campaign->access_water }} @endisset">
                        @error('access_water')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>
                        
                        <div class="form-group">
                        <label for="access_electricity">Access to electricity (Accessible/ Not Accessible ?)</label>
                        <input name="access_electricity" type="text" class="form-control @error('access_electricity') is-invalid @enderror" id="access_electricity" aria-describedby="access_electricity" placeholder="Enter access_electricity" 
                                value="{{ old('access_electricity') }} @isset($campaign) {{ $campaign->access_electricity }} @endisset">
                        @error('access_electricity')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>
                        
                        <div class="form-group">
                        <label for="clean_clothes">Access to clean clothes (Accessible/ Not Accessible ?)</label>
                        <input name="clean_clothes" type="text" class="form-control @error('clean_clothes') is-invalid @enderror" id="clean_clothes" aria-describedby="clean_clothes" placeholder="Enter clean_clothes" 
                                value="{{ old('clean_clothes') }} @isset($campaign) {{ $campaign->clean_clothes }} @endisset">
                        @error('clean_clothes')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                        </div>

                        <p>Kids :</p>

                        <!-- 'answers.*.answer' => 'required',
                        'kids.*.first_name' => 'required', -->

                        <!-- 
                            @for ($i = 0; $i < 10; $i++)
                                The current value is {{ $i }}
                            @endfor 
                        -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" >
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        @for ($i = 0; $i < 10; $i++)
                                The current value is {{ $i }}
                        @endfor 
                                                
                        <div class="form-group">
                            <label for="kid1">First Name</label>
                            <input name="kids[][first_name]" 
                            type="text" 
                            value="{{ old('kids.0.first_name') }}" 
                            autocomplete="off"
                            class="form-control" id="kid1" 
                            aria-describedby="choiceHelp" 
                            placeholder="Enter First Name">
                        
                            @error('kids.0.first_name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>    
                                    

                        <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
