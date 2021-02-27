@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('stylesheets')
    <style>
        .card-empty{
            background-size: cover;
            background-color: rgba(115, 103, 240, 0.12) !important;
        }
    </style>
@endsection
@section('content')
<section>
    <div class="row mb-2">
        <div class="col-md-9">
            <h2 class="float-left mb-0">Services</h2>
        </div>
        <div class="col-md-3">
            <button class="float-right btn btn-primary btn-round" type="button" data-toggle="modal" data-target="#create-modal">Create</button>
        </div>
    </div>
</section>
<section>
<div class="row">
    @forelse($services as $service)
    <div class="col-md-6 col-lg-4">
        <div class="card text-center">
            <img class="card-img-top" src="{{Storage::url(@$service->thumbnail->url)}}" alt="Card image cap" />
            <div class="card-body">
                <h4 class="card-title">{{$service->title}}</h4>
                <p class="card-text">
                    {{$service->description}}
                </p>
            </div>
            <div class="card-footer">
                <div class="progress-wrapper mb-2">
                    <div id="example-caption-2">Php {{number_format($service->price)}} / Hour</div>
                </div>
                <div class="text-center">
                    <div class="btn btn-primary btn-sm btn-round">View</div>
                    <div class="btn btn-primary btn-sm btn-round">Edit</div>
                    <div class="btn btn-danger btn-sm btn-round">Delete</div>
                </div>
            </div>
        </div>
    </div>
    @empty 
    <div class="col-lg-12">
        <div class="card card-empty">
            <div class="card-body text-center d-flex justify-content-center align-items-center">
                <!-- main title -->
                <h2 class="text-primary">No Services Found!</h2>
            </div>
        </div>
    </div>
    @endforelse
</div>
</section>    
@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('jobseeker.services.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="thumbnail" class="mb-1">Service Thumbnail</label>
                                    <div class="media">
                                        <a href="javascript:void(0);" class="mr-25">
                                            <img src="../../../app-assets/images/portrait/small/no-image.png" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                        </a>
                                        <!-- upload and reset button -->
                                        <div class="media-body mt-75 ml-1">
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                            <input type="file" name="thumbnail" id="account-upload" accept="image/*" style="display: none" />
                                            <button class="btn btn-sm btn-outline-secondary mb-75" id="upload-btn-reset" type="button">Reset</button>
                                            <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                        </div>
                                        <!--/ upload and reset button -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Service Price(per hour)</label>
                                    <input type="text" id="price" name="price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration of Service (hours)</label>
                                    <input type="number" id="duration" name="duration" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location of Service</label>
                                    <input type="text" id="location" name="location" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="title">Service Title</label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="category">Service Category</label>
                                    <div class="demo-inline-spacing">
                                        @foreach($service_categories as $category)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="category[]" value="{{$category->id}}" id="customCheck{{$loop->index}}">
                                            <label class="custom-control-label" for="customCheck{{$loop->index}}">{{$category->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="campaigncategory">Campaign Category</label>
                                    <select name="campaign_category[]" id="campaigncategory" class="form-control">
                                        @foreach($campaign_categories as $category)
                                        <option value="">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input name="tags" id="tagsinput" class="tagsinput" value="" />
                                    <span class="badge badge-danger">NOTE!</span><span class="help-inline">Press enter or commas to separate tags</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Service Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendors_js')
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/jquery/jquery.tagsinput.js')}}"></script>
@endsection
@section('scripts')
<script src="{{ asset('app-assets/js/scripts/pages/jobseeker/services.js') }}"></script>    
@endsection