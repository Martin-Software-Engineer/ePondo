@extends('backer.layouts.main')

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
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-3">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0 mb-0">
                        <!-- Service Details - Start -->
                        <div class="col">
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Order Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Service Order No. : </strong>{{$order_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Delivery Date : </strong>{{date('F d, Y', strtotime($order->details->render_date))}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Location :</strong> {{$order->details->delivery_address}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Payment Method :</strong> {{$order->details->payment_method}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Customer Name:</strong> {{$order->backer->userinformation->firstname}} {{$order->backer->userinformation->lastname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Additional Message :</strong> {{$order->details->message}}</h6>

                            <hr style="margin-top:30px;margin-bottom:30px;position: relative;border: none;height: 1px;background:#120a78 ;">
                            
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Service Details</h6>    
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Title : </strong> <span style="font-style:italic"> " {{$order->service->title}} " </span></h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Category : </strong>
                                @foreach($order->service->categories as $category)
                                    {{$category->name}} @if(!$loop->last)/@endif
                                @endforeach
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Location : </strong> {{$order->service->location}} </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Duration : </strong>
                                @if( $order->service->duration_hours > 1 ) {{$order->service->duration_hours}} Hrs @elseif( $order->service->duration_hours == 0 )  @else {{$order->service->duration_hours}} Hr @endif
                                @if( $order->service->duration_minutes > 1 ) {{$order->service->duration_minutes}} Mins @elseif( $order->service->duration_minutes == 0 )  @else {{$order->service->duration_minutes}} Min @endif
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Price : </strong>{{ucfirst($order->service->currency)}} {{number_format($order->service->price, 2)}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Jobseeker Name : </strong>{{$order->service->jobseeker->userinformation->firstname}} {{$order->service->jobseeker->userinformation->lastname}}</h6>
                        </div>
                        <!-- Service Details - End -->
                    </div>
                    <!-- Header ends -->
                </div>
                <!-- Invoice Note starts -->
                
                <!-- Invoice Note ends -->
            </div>
        </div>
        <!-- /Invoice -->

         <!-- Actions -->
         <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            @if($order->status == 1)
            <div class="card mb-1">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:lightskyblue"> Pending Request </span> </h5>
                    <hr>
                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Please wait 1-3 days for Jobseeker to respond to your Service Order Request.</h6>
                    <hr class="">
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <button type="button" class="btn-cancel btn btn-danger btn-block" data-toggle="modal" data-target="#cancel-modal">
                        Cancel Order
                    </button>
                </div>
            </div>
            @endif
            @if($order->status == 2)
            <div class="card mb-1">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:#120a78"> Order Accepted </span> </h5>
                    <hr>
                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order has been Accepted. Payment Method is Cash on Delivery. Please be reminded that once jobseeker has delivered your service order, you must Pay accordingly to your Jobseeker.</h6>
                    
                    <hr class="">
                    @if ($order->details->payment_method == 'COD')
                    <a href="{{route('backer.order.invoice', $order->id)}}" class="btn btn-primary btn-block">View Invoice</a>
                    @endif
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <button type="button" class="btn-cancel btn btn-danger btn-block" data-toggle="modal" data-target="#cancel-modal">
                        Cancel Order
                    </button>
                </div>
            </div>
            @endif
            @if($order->status == 3)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:crimson"> Declined </span> </h5>
                    <hr>
                    <button  class=" btn btn-danger btn-block mb-75" style="font-size:12px;text-align:left;">
                        Reason : {{$decline->reason}}
                    </button>
                    <h6 style="font-size:12px; margin-bottom:20px; margin-top:20px;font-weight:400;"> Service Order Declined. We are sorry to hear that your service order request has been declined. If you have concerns & feedback please email us at <strong style="font-style:italic; text-decoration:underline;">epondo.co@gmail.com</strong style="font-style:italic; text-decoration:underline;"></h6>
                    <hr>
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            @endif
            @if($order->status == 4)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:limegreen"> Ongoing </span> </h5>
                    <hr>
                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order Ongoing</h6>
                    <hr>
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            @endif
            @if($order->status == 5)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:#FFC107"> Pending Payment </span> </h5>
                    <hr>
                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order is Complete. Please view Invoice and continue to Payment. </h6>
                    <a href="{{route('backer.order.invoice', $order->id)}}" class="btn btn-warning btn-block mb-2">View Invoice & Pay</a>
                    <hr>
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            @endif
            @if($order->status == 6)
            <div class="card mb-4">
                <div class="card-body">
                    @if(!$order->hasbackerfeedback)
                        <h5 style="font-weight:bolder;"> Status : <span style="color:darkmagenta"> Pending Feedback & Rating </span> </h5>
                        <hr>
                        <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order Delivered & Payment Successful.<br><br> Please provide Feedback & Rating for your jobseeker. </h6>
                        <button class="btn-feedback btn btn-block" style="background-color: blueviolet;color:white;" data-toggle="modal" data-target="#feedback-modal">Submit Feedback & Rating</button>
                    @endif
                    
                    @if($order->hasbackerfeedback)
                        <h5 style="font-weight:bolder;"> Status : <span style="color:mediumorchid"> Processing Jobseeker's Feedback & Rating </span> </h5>
                        <hr>
                        <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Currently processing Jobseeker's Feedback & Rating. We will notify you immediately once finished. Thank you! <br><br> Payment Successful, Thank you!.</h6>
                    @endif
                    <hr class="mt-2">
                    <a href="{{route('backer.order.invoice', $order->id)}}" class="btn btn-primary btn-block ">View Invoice </a>
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            @endif
            @if($order->status == 7)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:limegreen"> Completed </span> </h5>
                    <hr>
                    <h6 style="color:limegreen;font-weight:bolder;text-align:center;margin-bottom:10px;margin-top:20px;">CONGRATULATIONS!</h6>
                    <h6 style="font-size:12px; margin-bottom:20px;">Service Order Complete! On behalf of the whole ePondo Team, we would like to thank you for using our platform. We hope that you can continue to support ePondo. Thank you!</h6>
                    <hr>
                    <a href="{{route('backer.order.invoice', $order->id)}}" class="btn btn-primary btn-block mt-2">View Invoice </a>
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            @endif
            @if($order->status == 8)
            <div class="card mb-1">
                <div class="card-body">
                    <h5 style="font-weight:bolder;"> Status : <span style="color:red"> Cancelled </span> </h5>
                    <hr>
                    <button  class=" btn btn-block mb-75" style="font-size:12px;text-align:left;background-color:red;color:white;">
                    By : {{$cancel->from}} <br>
                    Reason : {{$cancel->reason}}
                    </button>
                    <h6 style="font-size:12px; margin-bottom:20px;margin-top:20px;font-weight:400;">Service Order Cancelled. We are sorry to hear that your service order has been cancelled. If you have concerns & feedback please email us at <span style="font-weight:bold;text-decoration:underline;">epondo.co@gmail.com</span> </h6>
                    <hr class="mt-2">
                    <a href="/chats/?contact_id={{$order->service->jobseeker->id}}" class="btn btn-primary btn-block ">Contact Jobseeker</a>
                </div>
            </div>
            @endif
        </div>
        <!-- /Actions -->

    </div>
</section>   
@endsection
@section('modals')
<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Feedback & Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('backer.feedbacks.store')}}" method="POST">
                @csrf
                <input type="hidden" name="from" value="backer">
                <input type="hidden" name="service_id" value="{{$order->service->id}}">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="service_feedback"> <b>How would you rate the overall service provided by the jobseeker?</b> </label>
                                <div class="demo-inline-spacing">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="service_rating" value="1" id="customCheckSR1">
                                        <label class="custom-control-label" for="customCheckSR1">1 Star</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="service_rating" value="2" id="customCheckSR2">
                                        <label class="custom-control-label" for="customCheckSR2">2 Star</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="service_rating" value="3" id="customCheckSR3">
                                        <label class="custom-control-label" for="customCheckSR3">3 Star</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="service_rating" value="4" id="customCheckSR4">
                                        <label class="custom-control-label" for="customCheckSR4">4 Star</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="service_rating" value="5" id="customCheckSR5">
                                        <label class="custom-control-label" for="customCheckSR5">5 Star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="service_feedback"> <b>Please provide feedback regarding the service provided & jobseeker.</b> </label>
                                <textarea name="service_feedback" id="service_feedback" cols="30" rows="6" class="form-control" placeholder="Input feedback here ..."></textarea>
                            </div>
                           
                            <div class="form-group">
                                <label for="category"> <b>How would you rate the overall experience with ePondo ?</b> </label>
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
                                <label for="platform_message"> <b>Please provide feedback regarding your experience with ePondo. </b> </label>
                                <textarea name="platform_message" id="platform_message" cols="30" rows="5" class="form-control" placeholder="Input feedback here ..."></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block" style="background-color: blueviolet;color:white;">Submit Feedback & Rating</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cancel Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('backer.orders.cancel')}}" method="POST">
                @csrf
                <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                <input type="hidden" name="from" id="from" value="backer">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span style="font-size:12px;font-weight:500;color:#dc3545">Reminder: Not permitted to Cancel Order 3 Days prior to Delivery Date</span>
                            <div class="form-group mt-1">
                                <label for="reason"> <strong>*Instructions :</strong> Please state the reason for cancellation below.</label>
                                <textarea name="reason" id="reason" cols="30" rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-block">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>
</div>   
@endsection
@section('scripts')
    <script>
        $(function(){
            'use strict';

            $('#cancel-modal').on('submit','form', function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $(this).find('button[type=submit]').prop('disabled', true);
                    },
                    success: function(resp) {
                        $(this).find('button[type=submit]').prop('disabled', false);
                        if(resp.success){
                            $('#cancel-modal').modal('hide');
                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            setTimeout(function(){
                                location.reload();
                            }, 2000)
                        }
                        else{
                            toastr['error'](resp.msg, 'Error!', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        $.each(xhr.responseJSON.errors, function(key, text) {
                            toastr['error'](text[0], 'Error!', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        });
                    }
                });
            });
            $('#feedback-modal').on('submit', 'form', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $(this).find('button[type=submit]').prop('disabled', true);
                    },
                    success: function(resp) {
                        $(this).find('button[type=submit]').prop('disabled', false);
                        if (resp.success) {
                            $('#feedback-modal').modal('hide');

                            toastr['success'](resp.msg, 'Success!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            setTimeout(function(){
                                location.reload();
                            }, 2000)
                        }
                    },
                    error: function(xhr, status, error){
                        $.each(xhr.responseJSON.errors, function(key, text) {
                            toastr['error'](text[0], 'Error!', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        });
                    }
                });
            });

        });
    </script> 
@endsection