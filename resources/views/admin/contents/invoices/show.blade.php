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
@section('stylesheets')
<style>
    .paypal-should-focus .paypal-button:focus, .paypal-should-focus .paypal-button-card:focus {
          outline: solid 2px Highlight;
          outline: auto 0px -webkit-focus-ring-color !important;
          outline-offset: 0 !important;
      }
      
      .card-payment .card-body{
        padding-top: 15px !important;
        padding-bottom: 15px !important;
      }
      .topay{
        font-size: 18px;
        font-weight: 500;
      }
      .topay .topay-amount{
        font-size: 20px;
        font-weight: 600;
      }

      .stripe-payment{
        width: 100%;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
          0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
      }

      .stripe-payment input{
        border-radius: 6px;
        margin-bottom: 6px;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        font-size: 16px;
        width: 100%;
        background: white;
      }

      .stripe-payment .result-message {
        line-height: 22px;
        font-size: 16px;
      }
      .stripe-payment .result-message a {
        color: rgb(89, 111, 214);
        font-weight: 600;
        text-decoration: none;
      }
      .stripe-payment .hidden {
        display: none;
      }
      .stripe-payment #card-error {
        color: rgb(105, 115, 134);
        text-align: left;
        font-size: 13px;
        line-height: 17px;
        margin-top: 12px;
      }
      .stripe-payment #card-element {
        border-radius: 4px 4px 0 0 ;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        width: 100%;
        background: white;
      }
      .stripe-payment #payment-request-button {
        margin-bottom: 32px;
      }
      /* Buttons and links */
      .stripe-payment button, #pay-by-card{
        background: #5469d4;
        color: #ffffff;
        font-family: Arial, sans-serif;
        border-radius: 0 0 4px 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
      }
      .stripe-payment button:hover,#pay-by-card:hover {
        filter: contrast(115%);
      }
      .stripe-payment button:disabled, #pay-by-card:disabled {
        opacity: 0.5;
        cursor: default;
      }
      /* spinner/processing state, errors */
      .stripe-payment .spinner,
      .stripe-payment .spinner:before,
      .stripe-payment .spinner:after {
        border-radius: 50%;
      }
      .stripe-payment .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
      }
      .stripe-payment .spinner:before,
      .stripe-payment .spinner:after {
        position: absolute;
        content: "";
      }
      .stripe-payment .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
      }
      .stripe-payment .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
      }
      @-webkit-keyframes loading {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      @keyframes loading {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
</style>
@endsection

@section('content')
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-md-9">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <div class="mb-0">
                                <img src="{{asset('app-assets/images/additional_pictures/navbar_logo_1.png')}}" style="max-width:250px">
                            </div>
                            <h6 class="card-text p-0" style="font-size: 9px; margin: 5px 0 20px 60px;">https://epondo.co / epondo.co@gmail.com</h6>
                        </div>
                        <div style=" align-items: flex-end;">
                            <h1 style="text-align:center;font-weight:bold;">INVOICE</h1>
                            <p class="card-text mb-0"> <span style="margin-right:50px;font-weight:500">Invoice No : </span> {{$invoice_no}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:55px;font-weight:500">Due Date : </span> {{$date_due}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:85px;font-weight:500">Status : </span>
                                @if($invoice_status ==1 )
                                Ongoing
                                @elseif($invoice_status ==2 )
                                Pending Payment
                                @elseif($invoice_status ==3 )
                                Paid
                                @elseif($invoice_status ==4 )
                                Cancelled
                                @endif
                            </p>
                            <p class="card-text mb-0"> <span style="font-weight:500">Payment Method : </span> {{$payment_method}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:4px;font-weight:500">Service Order No : </span>  {{$order_no}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:45px;font-weight:500">Date Issued : </span> {{$date_issued}}</p>
                            
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>
                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="d-flex">
                        <div style="width:50%;">
                            <h6 class="" style="text-align:left;padding:10px 0;margin-right:30px;border-bottom: 2px solid #041151; color:#041151;font-weight:bold;">BILL TO</h6>
                            <p class="card-text mb-25" style="font-size: 12px;"><strong>Name : </strong>{{$to->name}}</p>
                            <p class="card-text mb-25" style="font-size: 12px;">
                                <strong>Address :</strong>
                                @if (empty($to->address))
                                    N/A 
                                @else
                                    {{$to->address}}
                                @endif
                            </p>
                            <p class="card-text mb-25" style="font-size: 12px;">
                                <strong>Contact No. :</strong>
                                @if (empty($to->contact))
                                    N/A 
                                @else
                                    {{$to->contact}}
                                @endif
                            </p>
                            <p class="card-text mb-25" style="font-size: 12px;"><strong>Email : </strong>{{$to->email}}</p>
                        </div>
                        <div style="width:50%;">
                            <h6 class="" style="text-align:left;padding:10px 0;margin-right:30px;border-bottom: 2px solid #041151; color:#041151;font-weight:bold;">BILL FROM</h6>
                            <p class="card-text mb-25" style="font-size: 12px;"><strong>Name : </strong>{{$from->name}}</p>
                            <p class="card-text mb-25" style="font-size: 12px;">
                                <strong>Address :</strong>
                                @if (empty($from->address))
                                    N/A 
                                @else
                                    {{$from->address}}
                                @endif
                            </p>
                            <p class="card-text mb-25" style="font-size: 12px;">
                                <strong>Contact No. :</strong>
                                @if (empty($from->contact))
                                    N/A 
                                @else
                                    {{$from->contact}}
                                @endif
                            </p>
                            <p class="card-text mb-25" style="font-size: 12px;"><strong>Email : </strong>{{$from->email}}</p>
                        </div>
                    </div>
                </div>
                <!-- Address and Contact ends -->
                <!-- Invoice Description starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="d-flex " >
                        <div style="border: 2px solid rgb(235, 228, 228);width:50%">
                            <div style="text-align:center;background-color:rgb(235, 228, 228);padding:5px 0;">
                                <h4>Description</h4>
                            </div>
                            <p class="card-text" style="font-size:12px; margin:10px 10px 0 10px;">
                                    <strong>Title : </strong>{{$service->title}}
                            </p>
                            <p class="card-text" style="font-size:12px; margin:10px 10px 0 10px;">
                                    <strong>Description : </strong>{{$service->description}}
                            </p>
                            <p class="card-text" style="font-size:12px; margin:10px 0 10px 10px;">
                                    <strong>Category : </strong>
                            
                            @foreach($service->categories as $category)
                                {{$category->name}} @if(!$loop->last)/@endif
                            @endforeach
                            </p>
                            <p class="card-text" style="font-size:12px; margin:10px 10px 0 10px;">
                                    <strong>Duration : </strong>{{$service->duration}}
                            </p>
                            <p class="card-text" style="font-size:12px; margin:10px 10px 10px 10px;">
                                    <strong>Location : </strong>{{$delivery_address}}
                            </p>
                            <p class="card-text" style="font-size:12px; margin:10px 10px 10px 10px;">
                                    <strong>Delivery Date : </strong>{{$order_date}}
                            </p>
                        </div>
                        <div style="border: 2px solid rgb(235, 228, 228);width:50%">
                            <div style="text-align:center;background-color:rgb(235, 228, 228);padding:5px 0;">
                                <h4 >Amount</h4>
                            </div>
                            <div style="text-align:center;margin-top:20px;">
                                <h2>Php {{$service->price}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex" style="display:flex;justify-content:flex-end;align-items:flex-end;margin-top:20px;">
                        <div style="text-align:right;margin-right:20px;">
                            <h6>Sub-Total : </h6>
                            <h6>Transaction Fee 7% : </h6>
                            <h6>Processing Fee 3% : </h6>
                            <h6>Added Charges : </h6>
                        </div>
                        <div style="text-align:right;margin:0 20px 0 10px">
                            <h6>{{$service->price}}</h6>
                            <h6>{{$transaction_fee}}</h6>
                            <h6>{{$processing_fee}}</h6>
                            <h6>{{$add_charges}}</h6>
                        </div>
                    </div>
                    <div class="d-flex" style="display:flex;justify-content:flex-end;align-items:flex-end;">
                        <div style="text-align:right;padding: 5px 20px 0px 80px;background-color: #041151;">
                            <h4 style="color: #ffffff;">Total : </h4>
                        </div>
                        <div style="text-align:right;padding: 5px 20px 0px 10px;background-color: #041151;">
                            <h4 style="color: #ffffff;">Php {{$total}}</h4>
                        </div>
                    </div>
                </div> 
                <!-- Invoice Description ends -->
                <!-- Invoice Note starts -->
                <!-- Invoice Note ends -->
                <!-- Invoice Footer start -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-xl-12 p-0 mt-xl-0 mt-2 mb-3 text-center">
                            <p> If you have any questions about this invoice please email us at epondo.co@gmail.com</p>
                            <h5>Thank you!</h5>
                        </div>
                    </div>
                </div>
                <!-- Invoice Footer end -->
            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        @if($payment_method == 'OP' && $invoice_status < 3 )
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size:14px;margin-bottom:10px;font-weight:bold;text-decoration:underline;">Payment Instructions : </h6>
                    <h6 style="font-size:12px;margin-bottom:10px;margin-top:20px;">Payment Method is Online Payment via (Paypal / Credit Card / Debit Card). Process payment by clicking the "Pay" button below. You will be routed to the Paypal payment gateway.</h6>
                    <h6 style="font-size:12px;margin-bottom:20px;margin-top:20px;font-weight:lighter">If you have any questions or concerns you may email us at epondo.co@gmail.com</h6>
                    <button class="btn-payment btn btn-success btn-block" style="font-size:16px;" data-toggle="modal" data-target="#add-payment-sidebar" disabled>
                        Pay
                    </button>
                </div>
            </div>
        </div>
        @elseif($payment_method == 'COD' && $invoice_status < 3 )
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size:14px;margin-bottom:10px;font-weight:bold;text-decoration:underline;">Payment Instructions : </h6>
                    <h6 style="font-size:12px;margin-bottom:10px;margin-top:20px;">Payment Method is Cash on Delivery. Please be reminded that once jobseeker has delivered your service order, you must Pay accordingly to your Jobseeker. Thank you.</h6>
                    <h6 style="font-size:12px;margin-bottom:10px;margin-top:20px;font-weight:lighter">If you have any questions or concerns you may email us at epondo.co@gmail.com</h6>
                </div>
            </div>
        </div>
        @endif
        <!-- /Invoice Actions -->

    </div>
</section>   
@endsection

