@extends('admin.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('css')
    <style>
        .tagsinput{
            height: unset !important;
        }
    </style>
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
    <section class="create-campaign-wrapper">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{route('admin.campaigns.update', $campaign->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="campaign-id">Title</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="title" class="form-control" name="title" value="{{$campaign->title}}" placeholder="Campaign Title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="description">Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{$campaign->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="category">Category</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="category[]" id="category" class="select2 form-control" multiple>
                                                @foreach($categories as $category)
                                                    @php $selected = false @endphp
                                                    @foreach($campaign->categories as $cam_cat)
                                                        @if($category->id == $cam_cat->id)
                                                            @php $selected = true @endphp
                                                        @endif
                                                    @endforeach
                                                    <option value="{{$category->id}}" @if($selected) selected @endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="target-date">Target Date</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="date" name="target_date" id="target-date" value="{{$campaign->target_date}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="target-amount">Target Amount</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="target_amount" step=".01" id="target-amount" class="form-control" value="{{$campaign->target_amount}}" placeholder="00" aria-label="Amount (to the nearest peso)" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="tags">Tags</label>
                                        </div>
                                        <div class="col-sm-9">
                                            @php $tags = [] @endphp
                                            @foreach($campaign->tags as $tag)
                                                @php array_push($tags, $tag->name); @endphp
                                            @endforeach
                                            <input name="tags" id="tagsinput" class="tagsinput" value="{{join(",", $tags)}}" />
                                            <span class="badge badge-danger">NOTE!</span><span class="help-inline">Press enter or commas to separate tags</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row"><hr class="my-2"></div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="jobseeker-id">Job Seeker</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="jobseeker_id" id="jobseeker-id" class="form-control">
                                                @foreach($jobseekers as $jobseeker)
                                                    @php $selected = false @endphp
                                                    @if($jobseeker->id == $campaign->jobseeker->id)
                                                        @php $selected = true @endphp
                                                    @endif
                                                    <option value="{{$jobseeker->id}}" @if($selected) checked @endif>{{$jobseeker->username}}</small></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="thumbnail" class="mb-1">Campaign Thumbnail</label>
                                        <div class="media">
                                            <a href="javascript:void(0);" class="mr-25">
                                                <label for="thumbnail-input" style="cursor: pointer">
                                                    @if($campaign->thumbnail_url != '')
                                                        <img src="{{$campaign->thumbnail_url}}" id="thumbnail-preview" class="rounded mr-50" height="180" width="180" />
                                                    @else
                                                        <img src="../../../app-assets/images/portrait/small/no-image.png" id="thumbnail-preview" class="rounded mr-50" height="180" width="180" />
                                                    @endif
                                                </label>
                                            </a>
                                            <!-- upload and reset button -->
                                            <div class="media-body mt-75 ml-1">
                                                <input type="file" name="thumbnail" id="thumbnail-input" accept="image/*" style="display: none" />
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                    <label><span class="badge badge-danger">ADD MORE PHOTOS OR SELECT A FILE</span></label>
                                    <label>It must be a JPG, PNG, no larger than 200 MB.</label></label>


                                        <div class="media-group d-flex">
                                            @foreach($campaign->photos as $photo)
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <label for="images-input{{$photo->id}}" style="cursor: pointer">
                                                        <img src="{{Storage::url($photo->url)}}" class="images-preview rounded mr-50" height="60" width="60" />
                                                    </label>
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <input type="file" name="images[]" data-photo-id="{{$photo->id}}" id="images-input{{$photo->id}}" class="images-input" accept="image/*" style="display: none" />
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            @endforeach
                                            @php $left = 4 - count($campaign->photos) @endphp
                                            @if($left > 0)
                                                @for($i = 0; $i < $left; $i++)
                                                <div class="media">
                                                    <a href="javascript:void(0);" class="mr-25">
                                                        <label for="images-input{{$i}}" style="cursor: pointer">
                                                            <img src="../../../app-assets/images/portrait/small/no-image.png" class="images-preview rounded mr-50" height="60" width="60" />
                                                        </label>
                                                    </a>
                                                    <!-- upload and reset button -->
                                                    <div class="media-body mt-75 ml-1">
                                                        <input type="file" name="images[]" id="images-input{{$i}}" class="images-input" accept="image/*" style="display: none" />
                                                    </div>
                                                    <!--/ upload and reset button -->
                                                </div>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                   <label><span class="badge badge-danger">NOTE!</span><span class="help-inline ml-1">Add an image that clearly represents your CAMPAIGN. Choose one that looks good at different sizes — it’ll appear on your campaign page. </span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('vendors_js')
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/jquery/jquery.tagsinput.js')}}"></script>
@endsection

@section('scripts')
    <script>
        $(function(){
            'use strict'

            $(".tagsinput").tagsInput();

            var form = $('form'),
                thumbnailInput = $('#thumbnail-input'),
                thumbnailPreview = $('#thumbnail-preview'),
                imagesInput = $('.images-input');

            form.on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').prop('disabled', true);
                    },
                    success: function(resp) {
                        form.find('button[type=submit]').prop('disabled', false);
                        if (resp.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: resp.msg,
                                icon: 'success',
                                confirmButtonText: 'Campaigns List',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                },
                                buttonsStyling: false
                            }).then(function(result) {
                                location.href = "{{route('admin.campaigns.index')}}"
                            });
                        }
                    }
                });
            });

            $('.select2').each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    // the following code is used to disable x-scrollbar when click in select input and
                    // take 100% width in responsive also
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $this.parent()
                });
            });


            thumbnailInput.on('change', function(e) {
                var reader = new FileReader(),
                    files = e.target.files;
                reader.onload = function() {
                    if (thumbnailPreview) {
                        thumbnailPreview.attr('src', reader.result);
                    }
                };
                reader.readAsDataURL(files[0]);
            });

            imagesInput.on('change', function(e) {
                var input = $(this);
                var reader = new FileReader(),
                    files = e.target.files;
                reader.onload = function() {
                    input.parent().parent().find('.images-preview').attr('src', reader.result);
                };
                reader.readAsDataURL(files[0]);

                var myFormData = new FormData();
                myFormData.append('image', files[0]);
                myFormData.append('id',"{{$campaign->id}}");
                if(input.data('photoId')){
                    myFormData.append('photo_id', input.data('photoId'));
                }

                myFormData.append('_token', $('meta[name=csrf-token]').attr('content'));

                $.ajax({
                    url: "{{route('admin.campaigns.update-photos')}}",
                    type: 'POST',
                    processData: false, // important
                    contentType: false, // important
                    dataType : 'json',
                    data: myFormData,
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
