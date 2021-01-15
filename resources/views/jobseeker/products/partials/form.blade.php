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

    <div class="mb-3">
        <label for="product_category" class="mb-2">Product Category</label>
        @foreach($product_categories as $product_category)
            
            <div class="form-check @error('product_category') is-invalid @enderror">
                <input class="form-check-input @error('product_category') is-invalid @enderror" type="radio" 
                        name="product_category" id="{{$product_category->name}}" value="{{ $product_category->id }}"
                        
                        @isset($product) 
                        @if(in_array($product_category->id, $product->product_categories->pluck('id')->toArray())) checked 
                        @endif 
                        @endisset
                        
                >
                
                <label class="form-check-label" for="{{$product_category->name}}">
                    {{ $product_category->name }}
                </label>
                </div>
                
                

        @endforeach

        @error('product_category')
            <span class="invalid-feedback" role="alert">{{$message}}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>                   