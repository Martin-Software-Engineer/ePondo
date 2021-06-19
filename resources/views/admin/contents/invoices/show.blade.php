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
        <div class="col-md-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <h1><b>Invoice</b></h1>
                            <h4>
                                Service Order No. <span>{{$order_no}}</span>
                            </h4>
                            <p class="card-text mb-25">Date Period: {{$date_period}}</p>
                            <p class="card-text mb-25">Invoice No: {{$invoice_no}}</p>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>

                <hr class="invoice-spacing">

                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row invoice-spacing">
                        <div class="col-xl-8 p-0">
                            <h5 class="mb-2"><b>BILL FROM</b></h5>
                            <h6 class="mb-25">{{$from->name}}</h6>
                            <p class="card-text mb-25">{{$from->address}}</p>
                        </div>
                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                            <h5 class="mb-2"><b>BILL TO</b></h5>
                            <h6 class="mb-25">{{$to->name}}</h6>
                            <p class="card-text mb-25">{{$to->address}}</p>
                        </div>
                    </div>
                </div>
                <!-- Address and Contact ends -->

                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="py-1">Description</th>
                                <th class="py-1">Price (Per Hour)</th>
                                <th class="py-1">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25">Service:</p>
                                    <p class="card-text text-nowrap">
                                        {{$service->title}}
                                    </p>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">Php {{$service->price}} ({{$service->duration}})</span>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">Php {{$service->subtotal}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25">Additional Charges:</p>
                                    <p class="card-text text-nowrap">
                                        
                                    </p>
                                </td>
                                <td class="py-1">
                                    
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25">Transaction Fee</p>
                                </td>
                                <td class="py-1">
                                    
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">7% (Php {{$transaction_fee}})</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25">Payment Processing Fee</p>
                                </td>
                                <td class="py-1">
                                    
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">3% (Php {{$processing_fee}})</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Invoice Description ends -->

                <hr class="invoice-spacing">

                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-xl-4 p-0">
                            <h5 class="mb-2"><b>Additional Information</b></h5>
                            <h6 class="mb-25">Service Order No.</h6>
                        </div>
                        <div class="col-xl-8 p-0 mt-xl-0 mt-2 text-right">
                            <h5 class="mb-2"><b>Total Due</b></h5>
                            <h1 style="font-size: 3rem">Php {{$total}}</h1>
                        </div>
                    </div>
                </div>
                <!-- Invoice Note ends -->
            </div>
        </div>
        <!-- /Invoice -->
    </div>
</section>   
@endsection

