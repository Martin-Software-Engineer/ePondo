@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create Campaign</h1>
            <div class="card">

                <form method="POST" action="{{ route('jobseeker.campaigns.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="title" placeholder="Enter Title" 
                                value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="description" placeholder="Enter Description" 
                                value="{{ old('description') }}">
                        @error('description')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                        @foreach($campaign_categories as $campaign_category)
                            
                            <div class="form-check @error('campaign_category') is-invalid @enderror">
                                <input class="form-check-input @error('campaign_category') is-invalid @enderror" type="radio" 
                                        name="campaign_category" id="{{$campaign_category->name}}" value="{{ $campaign_category->id }}"
                                        
                                        @isset($user) 
                                        @if(in_array($campaign_category->id, $user->campaigns->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset
                                        
                                >
                                
                                <label class="form-check-label" for="{{$campaign_category->name}}">
                                    {{ $campaign_category->name }}
                                </label>
                                </div>

                        @endforeach

                        @error('campaign_category')
                            <span class="invalid-feedback" role="alert">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
