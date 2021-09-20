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
                            <!-- <p class="card-text mb-25">Contact No.:</p> -->
                            <h6 class="card-text p-0" style="font-size: 9px; margin: 5px 0 20px 60px;">https://epondo.co / epondo.co@gmail.com</h6>
                        </div>
                        <div style=" align-items: flex-end;">
                            <h1 style="text-align:center;font-weight:bold;">INVOICE</h1>
                            <p class="card-text mb-0"> <span style="margin-right:40px;font-weight:500">Date Issued : </span> {{$date_issued}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:50px;font-weight:500">Invoice No : </span>  {{$invoice_no}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:4px;font-weight:500">Service Order No : </span>  {{$order_no}}</p>
                            <p class="card-text mb-0"> <span style="margin-right:55px;font-weight:500">Due Date : </span>  {{$date_due}}</p>

                            <!-- <div class="row">
                                <div class="col"  style="font-size: 12px;">
                                    <p class="card-text mb-25">Date Issued:</p>
                                    <p class="card-text mb-25">Invoice No:</p>
                                    <p class="card-text mb-25">Service Order No:</p>
                                    <p class="card-text mb-25">Due Date:</p>
                                </div>
                                <div class="col"  style="font-size: 12px;">
                                    <p class="card-text mb-25">{{$date_issued}}</p>
                                    <p class="card-text mb-25">{{$invoice_no}}</p>
                                    <p class="card-text mb-25">{{$order_no}}</p>
                                    <p class="card-text mb-25">{{$date_due}}</p>
                                </div>
                            </div> -->
                            
                        </div>
                    </div>
                    <!-- Header ends -->
                    <!-- Header starts -->
                    <!-- <div class="d-flex justify-content-between flex-md-row  invoice-spacing mt-0">
                        <div class="col">
                            <h1><b>Invoice</b></h1>
                            <h4>
                                Service Order No. <span>{{$order_no}}</span>
                            </h4>
                            <p class="card-text mb-25">Date Period: </p>
                            <p class="card-text mb-25">Invoice No: </p>
                        </div>
                        <div class="col">
                            <h1><b>Invoice</b></h1>
                            <h4>
                                Service Order No. <span>{{$order_no}}</span>
                            </h4>
                            <p class="card-text mb-25">Date Period: </p>
                            <p class="card-text mb-25">Invoice No: </p>
                        </div>
                    </div> -->
                    <!-- Header ends -->
                </div>

                <!-- <hr class="invoice-spacing"> -->

                <!-- Address and Contact starts -->
                <!-- <div class="card-body invoice-padding pt-0">
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
                </div> -->
                <!-- <div class="card-body invoice-padding pt-0">
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div style="text-align:left;align-items:flex-start;">
                            <h5 class="mb-2"><b>BILL TO</b></h5>
                            <h6 class="mb-25">{{$to->name}}</h6>
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
                        <div>
                            <h5 class="mb-2"><b>BILL FROM</b></h5>
                            <h6 class="mb-25">{{$from->name}}</h6>
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
                </div> -->
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
                <!-- <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="py-1">Description</th>
                                <th class="py-1">Price (Per Hour)</th>
                                <th class="py-1">Amount</th>
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
                                    <span class="font-weight-bold">Php {{$service->price}}</span>
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
                </div> -->
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
                        </div>
                        <div style="border: 2px solid rgb(235, 228, 228);width:50%">
                            <div style="text-align:center;background-color:rgb(235, 228, 228);padding:5px 0;">
                                <h4 >Amount</h4>
                            </div>
                            <!-- <div style="display:flex;justify-content:center;align-items:center"> -->
                            <div style="text-align:center;margin-top:20px;">
                                <h2>Php {{$service->price}}</h2>
                            </div>
                        </div>
                        <!-- <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr style="border: 2px solid rgb(235, 228, 228);">
                                        <th class="py-1" style="border: 2px solid rgb(235, 228, 228); width:80%;">Description</th>
                                        <th class="py-1 text-right" style="border: 2px solid rgb(235, 228, 228);">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border: 2px solid rgb(235, 228, 228);">
                                        <td class="py-1" style="border: 2px solid rgb(235, 228, 228); width:80%;">
                                            <p class="card-text text-nowrap">
                                                 Title :{{$service->title}}
                                            </p>
                                            <p class="card-text text-nowrap">
                                                 Description :
                                            </p>
                                            <p class="card-text text-nowrap">
                                                 Category :
                                            </p>
                                            <p class="card-text text-nowrap">
                                                 Duration :
                                            </p>
                                            <p class="card-text text-nowrap">
                                                 Location :
                                            </p>
                                        </td>
                                        <td class="py-1 text-right" style="border: 2px solid rgb(235, 228, 228);">
                                            <span class="font-weight-bold ">Php {{$service->price}}.00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <h6><b>Sub-Total : </b></h6>
                                            <h6><b>Transaction Fee 7% : </b></h6>
                                            <h6><b>Payment Processing Fee 3% : </b></h6>
                                            <h3><b>T O T A L : </b></h3>
                                        </td>
                                        <td class="text-right">
                                            <h6>{{$total}} </h6>
                                            <h6>{{$transaction_fee}} </h6>
                                            <h6>{{$processing_fee}} </h6>
                                            <h3>Php {{$total}} </h3>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    <div class="d-flex" style="display:flex;justify-content:flex-end;align-items:flex-end;margin-top:20px;">
                        <div style="text-align:right;margin-right:20px;">
                        <!-- <div style="text-align:right;padding: 10px 20px 5px 110px"> -->
                            <h6>Sub-Total : </h6>
                            <h6>Transaction Fee 7% : </h6>
                            <h6>Processing Fee 3% : </h6>
                            <!-- <h6>T O T A L : </h6> -->
                        </div>
                        <div style="text-align:right;margin:0 20px 0 10px">
                        <!-- <div style="text-align:right;padding: 10px 20px 5px 20px;"> -->
                            <h6>{{$service->price}}</h6>
                            <h6>{{$transaction_fee}}</h6>
                            <h6>{{$processing_fee}}</h6>
                            <!-- <h6> 830.00</h6> -->
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

                <!-- <hr class="invoice-spacing"> -->

                <!-- Invoice Note starts -->
                <!-- <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-xl-12 p-0 mt-xl-0 mt-2 mb-3 text-right">
                            <h6><b>Sub-Total : </b> Php {{$total}} </h6>
                            <h6><b>Transaction Fee : </b> Php {{$transaction_fee}} </h6>
                            <h6><b>Payment Processing Fee : </b> Php {{$processing_fee}} </h6>
                            <h3><b>Total Due : </b> Php {{$total}} </h3>
                        </div>
                    </div>
                </div> -->
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
    </div>
</section>   
@endsection

