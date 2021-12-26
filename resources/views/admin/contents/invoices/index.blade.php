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
<section class="invoices-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="invoices-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Invoice No.</th>
                        <th>Jobseeker Name</th>
                        <th>Jobseeker ID</th>
                        <th>Backer Name</th>
                        <th>Backer ID</th>
                        <th>Status</th>
                        <th>Service Title</th>
                        <th>Serivce Order No.</th>
                        <th>Service Category</th>
                        <th>Date of Service</th>
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
<script src="{{asset('/app-assets/js/scripts/pages/app-invoices.js')}}"></script>
@endsection

