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
                            <!-- <tr>
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
                            </tr> -->
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
                        <!-- <div class="col-xl-4 p-0">
                            <h5 class="mb-2"><b>Additional Information</b></h5>
                            <h6 class="mb-25">Service Order No.</h6>
                        </div> -->
                        <div class="col-xl-12 p-0 mt-xl-0 mt-2 mb-3 text-right">
                            <h5 class="mb-2"><b>Total Due</b></h5>
                            <h1 style="font-size: 3rem">Php {{$total}}</h1>
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
                    <button class="btn-payment btn btn-success btn-block" data-toggle="modal" data-target="#add-payment-sidebar">
                        Add Payment
                    </button>
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>
</section>   
@endsection

@section('modals')
<div class="modal fade" id="selectPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:400px" role="document">
      <div class="modal-content">
        <div class="loader"></div>
        <div class="card card-payment text-center hide">
          <div class="card-header pb-0">
            <h2 class="card-title"><strong>Pay your Invoice #{{$invoice_no}}</strong></h2>
          </div>
          <div class="card-body">
              <h3 class="topay">Amount to pay  <span class='topay-amount'>Php {{$total}}</span></h3>
              <div class="links">
                <div id="paypal-button" data-order-id="{{$order_id}}" data-currency="{{$currency}}"></div>
              </div>
              <p class="mt-1">or</p>
              <button type="button" id="pay-by-card" data-order-id="{{$order_id}}" data-currency="{{$currency}}">
                <span id="button-text">Pay with Card</span>
              </button>
              <form id="payment-form" class="stripe-payment d-none">
                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                <button id="submit">
                  <div class="spinner hidden" id="spinner"></div>
                  <span id="button-text">Pay</span>
                </button>
                <p id="card-error" role="alert"></p>
                <p class="result-message hidden">
                  Payment succeeded, see the result in your
                  <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                </p>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $(function(){
        'use strict';

        var paymentButton = $(".btn-payment"),
            selectPaymentModal = $('#selectPaymentMethodModal');

        paymentButton.on('click', function(){
            selectPaymentModal.modal('show');
        });

        paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
                size: 'responsive',
                color: 'blue',
                shape: 'pill',
                label: 'paypal',
                tagline: 'false'
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
            // 2. Make a request to your server
                var order_data = $('#paypal-button').data();
                return actions.request.post("{{route('api.order_create_paypal')}}", {
                    order_id : order_data.orderId,
                    currency : order_data.currency
                }).then(function(res) {
                    // 3. Return res.id from the response
                    return res.id;
                });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
            // 2. Make a request to your server
            return actions.request.post("{{route('api.order_execute_paypal')}}", {
                paymentID: data.paymentID,
                payerID:   data.payerID
            })
                .then(function(res) {
                    if(res.state = 'approved'){
                        $('#selectPaymentMethodModal').modal('hide');
                        Swal.fire({
                            title: 'Payment Successful',
                            text: 'Your donation was successful, Thank You!',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        })
                    }
                });
            }
        }, '#paypal-button');
        
        var stripe = Stripe("{{env('STRIPE_PUB_KEY')}}");

        var stripePayment = function(order_id, currency){
            var donate = { order_id, currency  };

            fetch("{{route('api.order_create_stripe')}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(donate)
            }).then(function(result) {
                return result.json();
            }).then(function(data) {
                var elements = stripe.elements();
                var style = {
                    base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#32325d"
                    }
                    },
                    invalid: {
                    fontFamily: 'Arial, sans-serif',
                    color: "#fa755a",
                    iconColor: "#fa755a"
                    }
                };
                var card = elements.create("card", { style: style });
                // Stripe injects an iframe into the DOM
                card.mount("#card-element");
                card.on("change", function (event) {
                    // Disable the Pay button if there are no card details in the Element
                    document.querySelector("button").disabled = event.empty;
                    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
                });
                var form = document.getElementById("payment-form");
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    // Complete payment when the submit button is clicked
                    payWithCard(stripe, card, data.clientSecret);
                });
            });

        }

        
        // Calls stripe.confirmCardPayment
        // If the card requires authentication Stripe shows a pop-up modal to
        // prompt the user to enter authentication details without leaving your page.
        var payWithCard = function(stripe, card, clientSecret) {
        stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer
                    showError(result.error.message);
                } else {
                    // The payment succeeded!
                    orderComplete(result.paymentIntent.id);
                }
            });
        };

        /* ------- UI helpers ------- */
        // Shows a success message when the payment is complete
        var orderComplete = function(paymentIntentId) {
            $.ajax({
                url: "{{route('api.order_confirm_stripe')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: paymentIntentId
                }, 
                success: function(resp){
                    if(resp.success){
                        $('#selectPaymentMethodModal').modal('hide');
                        Swal.fire({
                            title: 'Payment Successful',
                            text: 'Your payment was successful, Thank You!',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        })
                    }
                }
            });
            document.querySelector("button").disabled = true;
        };

        $('#pay-by-card').on('click', function(){
            var data = $(this).data();
            $(this).addClass('d-none');
            $('.stripe-payment').removeClass('d-none');
            stripePayment(data.orderId, data.currency);
        });
    });
    
</script>
@endsection