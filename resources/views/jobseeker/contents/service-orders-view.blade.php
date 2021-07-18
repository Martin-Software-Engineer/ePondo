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
    <h2>Service Order</h2>
    <div class="row invoice-preview">
        <!-- Service Order View -->
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Service Details - Start -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div class="col">
                            <h6 style="color:#120a78;margin-bottom:30px;border-bottom: 3px solid #120a78;">Service Order No. : <b>{{$order_id}}</b> </h6>
                            <h6>Title : <span style="font-style:italic;"> "{{$order->service->title}}" </span> </h6>
                            <h6>
                                Category :
                                            @foreach($order->service->categories as $category)
                                                {{$category->name}} @if(!$loop->last)/@endif
                                            @endforeach
                            </h6>
                            <h6>Duration :
                                            @if( $order->service->duration_hours > 1 ) {{$order->service->duration_hours}} Hrs @elseif( $order->service->duration_hours == 0 )  @else {{$order->service->duration_hours}} Hr @endif
                                            @if( $order->service->duration_minutes > 1 ) {{$order->service->duration_minutes}} Mins @elseif( $order->service->duration_minutes == 0 )  @else {{$order->service->duration_minutes}} Min @endif
                            </h6>
                            <h6>Price : {{ucfirst($order->service->currency)}} {{number_format($order->service->price, 2)}}</h6>
                        </div>
                    </div>
                    <!-- /Service Details - End -->
                </div>
                <hr class="m-0"/>
                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding">
                    <div class="col">
                        <h6>Service Order Date : {{date('F d, Y', strtotime($order->details->render_date))}}</h6>
                        <h6>Location : {{$order->details->delivery_address}}</h6>
                        <h6>Customer : {{$order->backer->userinformation->firstname}} {{$order->backer->userinformation->lastname}}</h6>
                        <h6 class="mt-2">Additional Message : {{$order->details->message}}</h6>
                    </div>
                </div>
                <!-- /Invoice Note ends -->
            </div>
        </div>
        <!-- Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6>Instrucitons:</h6>
                    @if($order->status == 1)
                    <p style="font-size:12px; margin-bottom:20px;">Please read the details of the service order request. Then click the appropriate button below.</p>
                    <button type="button" class="btn-accept btn btn-primary btn-block mb-75">
                        Accept
                    </button>
                    <button type="button" class="btn-decline btn btn-danger btn-block mb-75">
                        Decline
                    </button>
                    @endif

                    @if($order->status == 2)
                    <div style="font-size:12px; margin-bottom:20px; font-weight:lighter;">Once you have completed the service order for your customer, you may now submit service order complete by clicking the button below.</div>
                    <button type="button" class="btn-deliver btn btn-success btn-block mb-75">
                        Submit Service Order Delivered
                    </button>
                    @endif

                    @if($order->status == 5)
                    <p style="font-size:12px; margin-bottom:20px;">Service Order Submitted as Delivered. Please wait 1-3 days for processing of payment. Thank you! </p>
                    <button type="button" class="btn-deliver btn btn-warning btn-block mb-75" disabled>
                        Payment Processing
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
        <!-- /Actions -->
        <!-- /Service Order View -->
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
