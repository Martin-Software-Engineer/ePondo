@extends('admin.layouts.main')

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
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection
@section('content')
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
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
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Customer :</strong> {{$order->backer->userinformation->firstname}} {{$order->backer->userinformation->lastname}}</h6>
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
            <div class="card mb-1">
                <div class="card-body">
                        @if($order->status == 1)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:lightskyblue"> Pending Request </span> </h5>
                            <hr>
                            <h4 style="font-weight:bolder;">Backer</h4>
                                <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Please wait 1-3 days for Jobseeker to respond to your Service Order Request.</h6>
                            <h4 style="font-weight:bolder;">Jobseeker</h4>
                            <h6 style="font-size:12px;font-weight:400;"> <strong>Instructions : </strong> Please read the details of the service order request. Then click the appropriate button below.</h6>
                            <h6 class="j_tag_trans mb-2">(Basahin ang mga detalye ng order request. Kapag ikaw ay sangayon sa lahat ng hinihiling ng customer at nais mong tanggapin ang order request, pindutin lamang ang "Accept". Kapag ikaw sumasalungat rito, pindutin ang "Decline")</h6>
                            <button type="button" class="btn-accept btn btn-primary btn-block mb-75" disabled>
                                    Accept
                                </button>
                                <button type="button" class="btn-decline btn btn-danger btn-block mb-75" disabled>
                                    Decline
                                </button>
                        @endif
                        @if($order->status == 2)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:limegreen"> Order Accepted </span> </h5>
                            <hr>
                            <h4 style="font-weight:bolder;">Backer</h4>
                                <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order has been Accepted. Payment Method is Cash on Delivery. Please be reminded that once jobseeker has delivered your service order, you must Pay accordingly to your Jobseeker.</h6>
                                @if ($order->details->payment_method == 'COD')
                                    <a class="btn btn-primary btn-block">View Invoice</a>
                                @endif
                            <h4 style="font-weight:bolder;margin-top:10px;">Jobseeker</h4>
                                @if ($order->details->payment_method == 'OP')
                                    <h6 style="font-size:12px;font-weight:400;"> <strong>Instructions : </strong>Once you have completed the service order for your customer, you may now submit service order delivered by clicking the button below.</h6>
                                    <h6 class="j_tag_trans mb-2">(Kapag iyong nakumpleto na ang service order para sa iyong customer, pindutin lamang ang "Submit Service Order Delivered". Ito ay nagkakahulugan na natapos mo na ang service order at naihatid na sa iyong customer ng kumpleto.)</h6>
                                    <button type="button" class="btn-deliver btn btn-success btn-block mb-75" disabled>
                                        Submit Service Order Delivered
                                    </button>
                                @elseif ($order->details->payment_method == 'COD')
                                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> <strong>Instructions : </strong>Once you have completed the service order for your customer and received full payment, please click the submit button below to complete service order.</h6>
                                    <h6 class="j_tag_trans mb-2">(Kapag iyong nakumpleto na ang service order para sa iyong customer at natanggap na ang kabuuang bayad, pindutin lamang ang "Submit Service Delivered & Payment Received". Ito ay nagkakahulugan na nakumpleto at naihatid mo na ang service order sa iyong customer at natanggap mo na rin ang kabuuang bayad para rito.)</h6>
                                    <button type="button" class="btn-deliver btn btn-success btn-block mb-75" disabled>
                                        Submit Service Delivered & Payment Received
                                    </button>
                                @endif
                        @endif
                        @if($order->status == 3)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:crimson"> Declined </span> </h5>
                            <hr>
                            <button  class=" btn btn-danger btn-block mb-75" style="font-size:12px;text-align:left;">
                                Reason : {{$decline->reason}}
                            </button>
                            <h4 style="font-weight:bolder;">Backer</h4>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order Declined. We are sorry to hear that your service order request has been declined. If you have concerns & feedback please email us at <strong style="font-style:italic; text-decoration:underline;">epondo.co@gmail.com</strong style="font-style:italic; text-decoration:underline;"></h6>
                            <h4 style="font-weight:bolder;">Jobseeker</h4>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;">Service Order Declined. We are sorry to hear that you declined the service order request. If you have concerns & feedback please email us at <span style="font-weight:bold;text-decoration:underline;">epondo.co@gmail.com</span> </h6>
                            <h6 class="j_tag_trans">(Ikinalulungkot namin malaman na hindi niyo tinaggap ang service order request. Kung merong kayong katanungan, puna o pagaalala maari niyo kaming kontakin gamit ang email sa epondo.co@gmail.com)</h6>
                            @endif
                        @if($order->status == 4)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:limegreen"> Ongoing </span> </h5>
                            <hr>
                            <h4 style="font-weight:bolder;">Backer</h4>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order Ongoing</h6>
                            <h4 style="font-weight:bolder;">Jobseeker</h4>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order is Ongoing  </h6>
                        @endif
                        @if($order->status == 5)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:#FFC107"> Pending Payment </span> </h5>
                            <hr>
                            <h4 style="font-weight:bolder;">Backer</h4>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order is Complete. Please view Invoice and continue to Payment. </h6>
                            <a class="btn btn-warning btn-block">View Invoice & Pay</a>
                            <h4 style="font-weight:bolder;margin-top:20px;">Jobseeker</h4>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Please wait 1-3 days as we process the payment. We will notify you immediately once payment is successful. Thank you! </h6>
                            <h6 class="j_tag_trans">(Maghintay lamang ng 1-3 araw para sa pag proceso ng bayad. Kapag na proceso na ng buo ang bayad, agad-agad namin kayong sasabihan. Maraming Salamat.)</h6>
                        @endif
                        @if($order->status == 6)
                            <h4 style="font-weight:bolder;">Backer</h4>
                                @if(!$order->hasbackerfeedback)
                                    <h5 style="font-weight:bolder;"> Status : <span style="color:darkmagenta"> Pending Feedback & Rating </span> </h5>
                                    <hr>
                                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order Delivered & Payment Successful.<br><br> Please provide Feedback & Rating for your jobseeker. </h6>
                                    <button class="btn-feedback btn btn-block" style="background-color: blueviolet;color:white;" >Add Feedback & Rating</button>
                                @endif
                                
                                @if($order->hasbackerfeedback)
                                    <h5 style="font-weight:bolder;"> Status : <span style="color:mediumorchid"> Processing Jobseeker's Feedback & Rating </span> </h5>
                                    <hr>
                                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Currently processing Jobseeker's Feedback & Rating. We will notify you immediately once finished. Thank you! <br><br> Payment Successful, Thank you!.</h6>
                                @endif

                            <h4 style="font-weight:bolder;margin-top:20px;">Jobseeker</h4>
                                @if(!$order->hasjobseekerfeedback)
                                    <h5 style="font-weight:bolder;"> Status : <span style="color:darkmagenta"> Pending Feedback & Rating </span> </h5>
                                    <hr>
                                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Service Order Delivered & Payment Successful. To view your Earnings, go to your "Earnings" Tab. <br><br> Please provide Feedback & Rating to Complete the Service Order. </h6>
                                    <h6 class="j_tag_trans mb-2">(Kumpleto na and iyong Service Order at natanggap na ang kabuuang bayad. Maari iyong makita ang mga natanggap na bayad sa "Earnings" Tab. Palala na magbigay ng iyong puna at marka upang maikompleto and service order, pindutin lamang ang "Submit Feedback & Rating")</h6>
                                    <button class="btn-feedback btn btn-block mb-75" style="background-color: blueviolet;color:white;"> Submit Feedback & Rating </button>   
                                @endif
                                
                                @if($order->hasjobseekerfeedback)
                                    <h5 style="font-weight:bolder;"> Status : <span style="color:mediumorchid"> Processing Backer's Feedback & Rating </span> </h5>
                                    <hr>
                                    <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;"> Currently processing Backer's Feedback & Rating. We will notify you immediately once finished. Thank you! <br><br> Payment Successful! To view your Earnings, go to your "Earnings" Tab.</h6>
                                    <h6 class="j_tag_trans">(Kasalukuyang prinoproceso ang puna at marka ng iyong customer. Aabisuhan namin kayo agad kung ito ay natapos na. Salamat! Matagumpay ang pagproceso ng kabuuang bayad, maari itong makita sa "Earnings" Tab)</h6>
                                @endif
                        @endif
                        @if($order->status == 7)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:limegreen"> Completed </span> </h5>
                            <hr>
                            <h6 style="color:limegreen;font-weight:bolder;text-align:center;margin-bottom:10px;">CONGRATULATIONS!</h6>
                            <h6 style="font-size:12px; margin-bottom:20px;">Service Order Complete! On behalf of the whole ePondo Team, we would like to thank you for using our platform. We hope that you can continue to support ePondo. Thank you!</h6>
                            <h6 class="j_tag_trans">                        (Kumpleto na ang iyong Service Order! Mula sa buong ePondo, kami ay nagpapasalamat sa paggamit ng among plataporma. Umaasa kami na patuloy parin kayo magsusuporta sa ePondo. Maraming Salamat!)</h6>
                        @endif
                        @if($order->status == 8)
                            <h5 style="font-weight:bolder;"> Status : <span style="color:crimson"> Cancelled </span> </h5>
                            <hr>
                            <button  class=" btn btn-danger btn-block mb-75" style="font-size:12px;text-align:left;">
                            By : {{$cancel->from}} <br>
                            Reason : {{$cancel->reason}}
                            </button>
                            <h6 style="font-size:12px; margin-bottom:20px;font-weight:400;">Service Order Cancelled. We are sorry to hear that your service order has been cancelled. If you have concerns & feedback please email us at <span style="font-weight:bold;text-decoration:underline;">epondo.co@gmail.com</span> </h6>
                            <h6 class="j_tag_trans">(Ikinalulungkot namin malaman na hindi natuloy ang service order, it ay cinancel. Kung merong kayong katanungan, puna o pagaalala maari niyo kaming kontakin gamit ang email sa epondo.co@gmail.com)</h6>
                        @endif
                </div>
            </div>       
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
                <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
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
                                <label for="service_feedback">How was the experience of your service with the customer</label>
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
                                <textarea name="service_feedback" id="service_feedback" cols="30" rows="6" class="form-control" placeholder="Give some feedback about the service rendered."></textarea>
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
                    }
                });
            });

        });
    </script> 
@endsection