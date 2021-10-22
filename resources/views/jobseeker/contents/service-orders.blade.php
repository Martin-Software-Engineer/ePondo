@extends('jobseeker.layouts.main')

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

@section('content')
<section class="orders-list-wrapper">
    <h2>Service Orders</h2>
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="orders-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Service Order No.</th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Service Price</th>
                        <th>Delivery Location</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th class="cell-fit">Actions</th>
                        </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('jobseeker.feedbacks.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="from" value="jobseeker">
                    <input type="hidden" name="service_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_feedback">How was the experience of your service with the customer/backer</label>
                                    <textarea name="service_feedback" id="service_feedback" cols="30" rows="6" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category">How was your experience using the platform?</label>
                                    <div class="demo-inline-spacing">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="platform_rating" value="very-good" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Very Good</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="platform_rating" value="good" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Good</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="platform_rating" value="bad" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Bad</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="platform_rating" value="very-bad" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4">Very Bad</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="platform_message">Message</label>
                                    <textarea name="platform_message" id="platform_message" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
<script src="{{asset('/app-assets/js/scripts/pages/jobseeker/orders.js')}}"></script>
@endsection
