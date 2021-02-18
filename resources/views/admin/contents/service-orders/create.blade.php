@extends('admin.layouts.main')

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
    <section class="create-campaign-wrapper">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="campaign-id">Title</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="title" class="form-control" name="title" placeholder="Campaign Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="description">Description</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="category">Category</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="category_id" id="category" class="form-control">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="user-id">Job Seeker</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="user_id" id="user-id" class="form-control">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="reset" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection