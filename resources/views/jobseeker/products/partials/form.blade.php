@csrf
<div class="form-group">                   
    <div class="form-group">
        <label for="name">name</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" placeholder="Enter name" 
                value="{{ old('name') }} @isset($product) {{ $product->name }} @endisset">
        @error('name')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="description" placeholder="Enter Description" 
                value="{{ old('description') }} @isset($product) {{ $product->description }} @endisset">
            
        @error('description')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    

    <button type="submit" class="btn btn-primary">Submit</button>
</div>                   