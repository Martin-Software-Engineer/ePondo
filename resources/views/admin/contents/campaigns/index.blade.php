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
    <div class="row mb-1">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{route('admin.campaigns.create')}}" class="btn btn-primary float-right">Create</a>
        </div>
    </div>
</section>
<section class="campaigns-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="campaigns-list-table table">
                <thead>
                    <tr>
                        <!-- <th></th>
                        <th>Campaign ID</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Jobseeker ID</th>
                        <th>Campaign Status</th>
                        <th>Campaign Title</th>
                        <th>Campaign category</th>
                        <th>Target Date</th>
                        <th>Target Amount</th>
                        <th>Amount Raised</th>
                        <th class="cell-fit">Actions</th> -->
                        <th></th>
                        <th>Campaign ID</th>
                        <th>Title</th>
                        <th>Target Date</th>
                        <th>Target Amount</th>
                        <th>Amount Raised</th>
                        <th>Jobseeker ID</th>
                        <th>Jobseeker Status</th>
                        <th class="cell-fit">Actions</th>

                        <!-- ID
                        Title
                        Target Date
                        Target Amount
                        Amount Raised
                        Jobseeker ID
                        Status -->
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
<script src="{{asset('/app-assets/js/scripts/pages/app-campaigns.js')}}"></script>
@endsection

