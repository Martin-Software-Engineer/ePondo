@csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="title" placeholder="Enter Title" 
                                autocomplete="off" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="description" placeholder="Enter Description" 
                            autocomplete="off" value="{{ old('description') }}">
                        @error('description')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="job_category" class="mb-2">job Category</label>
                        @foreach($job_categories as $job_category)
                            
                            <div class="form-check @error('job_category') is-invalid @enderror">
                                <input class="form-check-input @error('job_category') is-invalid @enderror" type="radio" 
                                        name="job_category" id="{{$job_category->name}}" value="{{ $job_category->id }}"
                                        
                                        @isset($user) 
                                        @if(in_array($job_category->id, $user->campaigns->jobs->pluck('id')->toArray())) checked 
                                        @endif 
                                        @endisset
                                        
                                >
                                
                                <label class="form-check-label" for="{{$job_category->name}}">
                                    {{ $job_category->name }}
                                </label>
                                </div>

                        @endforeach

                        @error('job_category')
                            <span class="invalid-feedback" role="alert">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    