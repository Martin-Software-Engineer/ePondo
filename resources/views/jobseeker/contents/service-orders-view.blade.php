@extends('jobseeker.layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/pages/app-invoice.css')}}">
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
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <div class="logo-wrapper">
                                <h3 class="text-primary">{{$order->service->title}}</h3>
                            </div>
                            <h1 class="mb-25 text-success">{{ucfirst($order->service->currency)}} {{number_format($order->service->price, 2)}}</h1>
                        </div>
                        
                        <div class="mt-md-0 mt-2">
                            <h4 class="invoice-title">
                                Order ID
                                <span class="invoice-number">#{{$order_id}}</span>
                            </h4>

                            <div class="invoice-date-wrapper">
                            <p class="invoice-date-title">Duration:</p>
                             <p class="invoice-date">{{$order->service->duration}} Hours</p>
                            </div>


                            <div class="invoice-date-wrapper">
                            <p class="invoice-date-title">Render Date:</p>
                            <p class="invoice-date">{{$order->details->render_date}}</p>
                            </div>

                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Location:</p>
                                <p class="invoice-date">{{$order->service->location}}</p>
                            </div>

                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Status:</p>
                                <p class="invoice-date">{{\App\Helpers\System::StatusTextValue($order->status)}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>

                <hr class="invoice-spacing" />

                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Backer:</span>
                            <span>{{$order->backer->username}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Message:</span>
                            <span>{{$order->details->message}}</span>
                        </div>
                    </div>
                </div>
                <!-- Invoice Note ends -->
            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    @if($order->status == 1)
                    <button type="button" class="btn-accept btn btn-primary btn-block mb-75">
                        Accept
                    </button>
                    <button type="button" class="btn-decline btn btn-danger btn-block mb-75">
                        Decline
                    </button>
                    @endif

                    @if($order->status == 2)
                    <button type="button" class="btn-deliver btn btn-success btn-block mb-75">
                        Deliver
                    </button>
                    @endif

                    @if($order->status == 5)
                    <button type="button" class="btn-deliver btn btn-success btn-block mb-75" disabled>
                        Submit as Delivered
                    </button>
                    @endif

                    @if($order->status == 6)
                    <button type="button" class="btn-feedback btn btn-info btn-block mb-75">
                        Add Feedback
                    </button>
                    @endif

                    @if($order->status == 7)
                    <button type="button" class="btn btn-primary btn-block mb-75" disabled>
                        Completed
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>
</section>
@endsection

@section('scripts')
    <script>
        $(function(){
            'use strict';

            $('.btn-accept').on('click', function(){
                $.ajax({
                    url: '/jobseeker/orders/{{$order->id}}/accept',
                    type: 'GET',
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            location.reload()
                        }
                    }
                });
            });

            $('.btn-deliver').on('click', function(){
                $.ajax({
                    url: '/jobseeker/orders/{{$order->id}}/deliver',
                    type: 'GET',
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            location.reload()
                        }
                    }
                });
            });

            $('.btn-decline').on('click', function(){
                $.ajax({
                    url: '/jobseeker/orders/{{$order->id}}/decline',
                    type: 'GET',
                    success: function(resp){
                        if(resp.success){
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            location.reload()
                        }
                    }
                });
            });
        });
    </script>
@endsection
