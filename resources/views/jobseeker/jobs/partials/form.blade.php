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

                    <button type="submit" class="btn btn-primary">Submit</button>
                    