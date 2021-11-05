@extends('jobseeker.layouts.main')

@section('vendors_css')
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
                <form class="form form-horizontal" action="{{route('jobseeker.services.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="campaign-id">Title</label>
                                            <span class="j_tag_trans">(Pamagat)</span>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="title" class="form-control" name="title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="description">Description</label>
                                            <span class="j_tag_trans">(Diskripsyon)</span>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="category">Category</label>
                                            <span class="j_tag_trans">(Kategorya)</span>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="category[]" id="category" class="select2 form-control" multiple>
                                                @foreach($category_parents as $parent)
                                                    <optgroup label="{{$parent->name}}">
                                                        @foreach($parent->categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="price">Price</label>
                                            <span class="j_tag_trans">(Presyo)</span>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="price" step=".01" id="price" class="form-control" placeholder="00" aria-label="Amount (to the nearest peso)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="duration">Duration</label>
                                            <span class="j_tag_trans"><br>(Haba ng oras ng serbisyo)</span>
                                        </div>
                                        <div class="col-sm-5">
                                            <select name="duration_hours" id="duration_hours" class="form-control">
                                                @for($i = 0; $i<=24; $i++)
                                                    <option value="{{$i}}">{{$i}} @if($i> 1)Hours @else Hour @endif</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="duration_minutes" id="duration_minutes" class="form-control">
                                                @for($i = 0; $i<=11; $i++)
                                                    <option value="{{$i*5}}">{{$i*5}} Minutes</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="location">Location</label>
                                            <span class="j_tag_trans">(Lokasyon)</span>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="location" id="location" class="form-control">
                                                @foreach($regions as $region)
                                                    <optgroup label="{{$region->name}}">
                                                        @foreach($region->cities as $city)
                                                            <option value="{{$city->name}}, {{$region->name}}">{{$city->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="tags">Tags</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input name="tags" id="tags" class="tagsinput" value="" />
                                            <span class="badge badge-danger mr-1">NOTE!</span><span class="help-inline">Press enter or commas to separate tags</span>
                                            <span class="j_tag_trans"><br>(Maglagay ng kuwit o pindutin and 'Enter', para hiwalayin ang tags)</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="thumbnail" class="mb-1">Service Thumbnail</label>
                                        <div class="media">
                                            <a href="javascript:void(0);" class="mr-25">
                                                <label for="thumbnail-input" style="cursor: pointer">
                                                    <img src="../../../app-assets/images/portrait/small/no-image.png" id="thumbnail-preview" class="rounded mr-50" height="180" width="180" />
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
                                    <label>Service Photos</label></label>
                                        <div class="media-group d-flex">
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <label for="images-input1" style="cursor: pointer">
                                                        <img src="../../../app-assets/images/portrait/small/no-image.png" class="images-preview rounded mr-50" height="60" width="60" />
                                                    </label>
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <input type="file" name="images[]" id="images-input1" class="images-input" accept="image/*" style="display: none" />
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <label for="images-input2" style="cursor: pointer">
                                                        <img src="../../../app-assets/images/portrait/small/no-image.png" class="images-preview rounded mr-50" height="60" width="60" />
                                                    </label>
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <input type="file" name="images[]" id="images-input2" class="images-input" accept="image/*" style="display: none" />
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <label for="images-input3" style="cursor: pointer">
                                                        <img src="../../../app-assets/images/portrait/small/no-image.png" class="images-preview rounded mr-50" height="60" width="60" />
                                                    </label>
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <input type="file" name="images[]" id="images-input3" class="images-input" accept="image/*" style="display: none" />
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            <div class="media">
                                                <a href="javascript:void(0);" class="mr-25">
                                                    <label for="images-input4" style="cursor: pointer">
                                                        <img src="../../../app-assets/images/portrait/small/no-image.png" class="images-preview rounded mr-50" height="60" width="60" />
                                                    </label>
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="media-body mt-75 ml-1">
                                                    <input type="file" name="images[]" id="images-input4" class="images-input" accept="image/*" style="display: none" />
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                <label><span class="badge badge-danger">NOTE!</span><span class="help-inline ml-1">Add photos that clearly represent your Service. It must be a JPG, PNG, no larger than 200 MB.</span></label>
                                <span class="j_tag_trans">(Maglagay ng mga litrato na kumakatawan sa iyong serbisyo. Aalalahaning ang laki ng litrato ay di lalagpas sa 200MB)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                
                                            </div>
                                            <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                            </div>
                                        </div>
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
                select = $('.select2'),
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
                    beforeSend: () => {
                        form.find('button[type=submit]').prop('disabled', true);
                        form.find('.invalid-feedback').remove();
                        form.find('.valid-feedback').remove();
                        form.find('.invalid-feedback.valid-feedback').remove();
                        form.find('input').removeClass('is-invalid');
                    },
                    success: (resp) => {
                        $(this).find('button[type=submit]').prop('disabled', false);
                        if (resp.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: resp.msg,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Services List',
                                cancelButtonText: 'Add New',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-outline-danger ml-1'
                                },
                                buttonsStyling: false
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    location.href = "{{route('jobseeker.services.index')}}"
                                }else{
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        $(this).find('button[type=submit]').prop('disabled', false);
                        $.each(xhr.responseJSON.errors, function(name, error) {
                            form.find('button[type=submit]').prop('disabled', false);
                            form.find('#' + name).siblings('.invalid-feedback').remove();
                            form.find('#' + name).siblings('.valid-feedback').remove();
                            form.find('#' + name).siblings('.invalid-feedback.valid-feedback').remove();
                            form.find('#' + name).addClass('is-invalid');
                            form.find('#' + name).after(`
                                <div class="invalid-feedback">
                                ${error}
                            </div>
                            `);
                        });
                    }
                });
            });
            select.each(function () {
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
            });
        });
    </script>
@endsection