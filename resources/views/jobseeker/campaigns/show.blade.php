@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4 mt-4">
            <h1>Campaign Title:</h1>
        </div>
        <div class="col mt-4">
            <h3>{{ $campaign -> title}}</h3>
        </div>
        
        <!-- <div><a class="btn btn-sm btn-success" href="{{ route('jobseeker.campaigns.create') }}" role="button">Create Campaign</a></div> -->
    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Description:</h4>
        </div>
        <div class="col mt-4">
            <p>{{ $campaign -> description}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Campaign Category:</h4>
        </div>
        
        <div class="col mt-4">
            @foreach($campaign->campaign_categories as $campaign_category)
            <p>{{ $campaign_category -> name }}</p>
            @endforeach
        </div>

    </div>

    <div class="row">
        <div class="col-4 mt-4">
            <h4>Campaign Photos:</h4>
        </div>
        
        <div class="col mt-4">
            @foreach($campaign->photos as $photo)
                    <!-- <img src="{!! Storage::disk('s3')->url('campaign/' . $photo->filename) !!}" alt="c_pic" width="100" height="100"> -->
                    <img src="{{ 'https://awssoftdevmartin-epondo-images.s3-ap-southeast-1.amazonaws.com/campaign/' . $photo->filename }}" alt="campaign_pic" width="100" height="100" >
            @endforeach
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign->id}}/edit" role="button">Edit Campaign Details</a>
            </div>
        </div>
    </div>

    <div class="row">
        <h1>Jobs</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="/jobseeker/campaigns/{{$campaign -> id}}/jobs/create" class="btn btn-dark">Add Job</a>
            </div>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
            <th scope="col">Job ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Job Photos</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            @foreach($job->job_categories as $job_category)
            <tr>
            <th scope="row">{{ $job->id }}</th>
            <td><a href="#">{{ $job -> title }}</a></td>
            <td>{{ $job -> description }}</td>
            <td>{{ $job_category->id }}</td>
            <td>{{ $job_category->name }}</td>
            <td>
            @foreach($job->photos as $photo)
                    <!-- <img src="{!! Storage::disk('s3')->url('campaign/' . $photo->filename) !!}" alt="c_pic" width="100" height="100"> -->
                    <img src="{{ 'https://awssoftdevmartin-epondo-images.s3-ap-southeast-1.amazonaws.com/job/' . $photo->filename }}" alt="job_pic" width="100" height="100" >
            @endforeach
            </td>
            <td>
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign -> id}}/jobs/{{$job->id}}" role="button">View</a>
            </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $jobs->links() }}

    <div class="row">
        <h1>Products</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="/jobseeker/campaigns/{{$campaign -> id}}/products/create" class="btn btn-dark">Add Product</a>
            </div>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Job Photo</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            @foreach($product->product_categories as $product_category)
            <tr>
            <th scope="row">{{ $product->id }}</th>
            <td><a href="#">{{ $product -> name }}</a></td>
            <td>{{ $product -> description }}</td>
            <td>{{ $product_category->id }}</td>
            <td>{{ $product_category->name }}</td>
            <td>
                <a class="btn btn-sm btn-primary" href="/jobseeker/campaigns/{{$campaign -> id}}/products/{{$product->id}}" role="button">View</a>
            </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
    

@endsection