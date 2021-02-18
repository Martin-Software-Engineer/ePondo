@extends('admin.layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
<style>
    .table-campaign-title{
        white-space: nowrap;
        overflow: hidden;
    }
    th { font-size: 12px; }
    td { font-size: 12px; }
</style>
@endsection

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
<section>
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <div class="p-0 m-0">
                <button class="btn btn-flat-secondary dropdown-toggle waves-effect" type="button" id="dropdownMenuButton600" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    By
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton600">
                    <a class="dropdown-item" href="javascript:void(0);">Option 1</a>
                    <a class="dropdown-item" href="javascript:void(0);">Option 2</a>
                    <a class="dropdown-item" href="javascript:void(0);">Option 3</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <a href="{{route('admin.campaigns.create')}}" class="btn btn-primary float-right">Create</a>
        </div>
    </div>
</section>
<section class="services-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="services-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Services ID</th>
                        <th>Jobseeker Name</th>
                        <th>Jobseeker ID</th>
                        <th>Service Title</th>
                        <th>Service category</th>
                        <th>Duration of Service</th>
                        <th class="cell-fit">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>    
@endsection

@section('external_js')
<script src="{{asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endsection
@section('scripts')
<script src="{{asset('/app-assets/js/scripts/pages/app-services.js')}}"></script>
@endsection

