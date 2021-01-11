@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-4">
                <form method="POST" action="{{ route('jobseeker.campaigns.update',$campaign->id) }}">
                <!-- /jobseeker/campaigns/{{ $campaign->id }} -->
                @csrf
                    @method('PUT')

                    <h1 class="mt-1">Edit Campaign</h1>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="title" placeholder="Enter title" 
                                value="{{ old('title') }} @isset($campaign) {{ $campaign->title }} @endisset">
                        @error('title')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="description" placeholder="Enter description" 
                                value="{{ old('description') }} @isset($campaign) {{ $campaign->description }} @endisset">
                        @error('description')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection