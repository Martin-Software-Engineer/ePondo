@extends('admin.layouts.main')

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
            <div class="card-body" >
                <form class="form form-horizontal" action="{{route('admin.service-orders.update', $order->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 >Service Order No. : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label col-form-label">
                                            <h6> {{$order_id}} </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Title : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <h6> "{{$order->service->title}}" </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Category : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <h6>
                                                @foreach($order->service->categories as $category)
                                                {{$category->name}} @if(!$loop->last)/@endif
                                                @endforeach    
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Duration : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <h6>
                                                @if( $order->service->duration_hours > 1 ) {{$order->service->duration_hours}} Hrs @elseif( $order->service->duration_hours == 0 ) @else {{$order->service->duration_hours}} Hr @endif
                                                @if( $order->service->duration_minutes > 1 ) {{$order->service->duration_minutes}} Mins @elseif( $order->service->duration_minutes == 0 ) @else {{$order->service->duration_minutes}} Min @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Price : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <h6>{{ucfirst($order->service->currency)}} {{number_format($order->service->price, 2)}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="target_date">Service Order Date : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <input type="date" name="target_date" id="target_date" value="{{$order->details->render_date}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Location : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <input type="text" id="location" class="form-control" name="location" value="{{$order->details->delivery_address}}" placeholder="City/Municipality/Province">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="customer">Customer : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <h6>{{$order->backer->userinformation->firstname}} {{$order->backer->userinformation->lastname}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="payment_method">Payment Method : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <select name="payment_method" id="payment_method" class="form-control select2">
                                                <option value="OP"  @if($order->details->payment_method == 'OP') selected @endif  >Online Payment (Available: Paypal,Credit Card)</option>
                                                <option value="COD"  @if($order->details->payment_method == 'COD') selected @endif  >Cash on Delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Additional Message : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{$order->details->message}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <h6 for="location">Status : </h6>
                                        </div>
                                        <div class="col-sm-9 col-form-label">
                                            <select name="orderstatus" id="orderstatus" class="select2 form-control">
                                                @for($i = 1; $i<=8; $i++)
                                                <option value="{{$i}}"  @if($i == $order->status) selected @endif  >
                                                    {{$i}}
                                                    @if($i== 1)Pending Request 
                                                    @elseif($i== 2)Order Accepted
                                                    @elseif($i== 3)Declined
                                                    @elseif($i== 4)Ongoing
                                                    @elseif($i== 5)Submitted as Complete & Pending Payment
                                                    @elseif($i== 6)Pending Feedback & Rating
                                                    @elseif($i== 7)Completed
                                                    @elseif($i== 8)Cancelled
                                                    @endif
                                                </option>
                                                @endfor
                                            </select>
                                            <div class="ml-1 mt-1">
                                            <strong style="font-size:12px; margin-bottom:20px;">NOTE : </strong>
                                            @if($order->status == 1)
                                            <p style="font-size:12px; margin-bottom:20px;"> Please wait 1-3 days for Jobseeker to respond to your Service Order Request.</p>
                                            @endif
                                            @if($order->status == 2)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order has been Accepted. Once service has been completed wait for Invoice and proceed to Payment. You may also contact your jobseeker by clicking the button below.</p>
                                            @endif
                                            @if($order->status == 3)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order Declined. We are sorry to hear that your service order request has been declined. If you have concerns & feedback please email us at <strong style="font-style:italic; text-decoration:underline;">epondo.co@gmail.com</strong style="font-style:italic; text-decoration:underline;"></p>
                                            @endif
                                            @if($order->status == 4)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order Ongoing. Once service has been completed wait for Invoice and proceed to Payment. You may also contact your jobseeker by clicking the button below.</p>
                                            @endif
                                            @if($order->status == 5)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order is Complete. Please view Invoice and continue to Payment. </p>
                                            @endif
                                            @if($order->status == 6)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order Complete & Payment Successful. Please provide Feedback & Rating for your jobseeker. </p>
                                            @endif
                                            @if($order->status == 7)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order Complete! On behalf of the whole ePondo Team, Thank you! </p>
                                            @endif
                                            @if($order->status == 8)
                                            <p style="font-size:12px; margin-bottom:20px;"> Service Order Cancelled. If you have any concerns & feedback email us at <strong style="font-style:italic; text-decoration:underline;">epondo.co@gmail.com</strong style="font-style:italic; text-decoration:underline;"> </p>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
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
                select = $('.select2');

            form.on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').prop('disabled', true);
                    },
                    success: function(resp) {
                        form.find('button[type=submit]').prop('disabled', false);
                        if (resp.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: resp.msg,
                                icon: 'success'
                            }).then(function(result) {
                                location.href = "{{route('admin.service-orders.index')}}"
                            });
                        }
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


            

            
        });
    </script>
@endsection