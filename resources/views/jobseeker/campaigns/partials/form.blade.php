@csrf
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

    <div class="mb-3">
        <label for="campaign_category" class="mb-2">Campaign Category</label>
        @foreach($campaign_categories as $campaign_category)
            
            <div class="form-check @error('campaign_category') is-invalid @enderror">
                <input class="form-check-input @error('campaign_category') is-invalid @enderror" type="radio" 
                        name="campaign_category" id="{{$campaign_category->name}}" value="{{ $campaign_category->id }}"
                        
                        @isset($campaign) 
                        @if(in_array($campaign_category->id, $campaign->campaign_categories->pluck('id')->toArray())) checked 
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

</div>