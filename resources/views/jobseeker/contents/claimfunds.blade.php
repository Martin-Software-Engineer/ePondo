@extends('jobseeker.layouts.main')

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection

@section('content')
<section class="app-claim-funds">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Withdraw Available Balance - Campaign Funds</h4>
            <!-- <h4 class="card-title">Claim Funds for "<span style="font-style:italic;text-decoration:underline;"> {{$campaign->title}} </span>"</h4> -->
        </div>
        <div class="card-body">
            <form class="form-validate" id="form-claim" action="{{route('jobseeker.funds.claim')}}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
                <div class="row">
                    <!-- <div class="col-md-8">
                        <div class="form-group">
                            <label for="amount" class="d-flex justify-content-between">Amount <small>Available funds : ₱{{$campaign->available_funds}}</small></label>
                            <input id="amount" type="number" class="form-control" name="amount" placeholder="{{$campaign->available_funds}}"/>
                        </div>
                        <div class="form-group">
                            <label for="paypal">Paypal Email</label>
                            <input id="paypal" type="text" class="form-control" name="paypal"/>
                        </div>
                        <div class="form-group">
                            <label for="details">Message</label>
                            <textarea name="details" id="details" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </div> -->
                    <!--  -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 style="">Campaign : </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <p style="margin-bottom:0;font-style:italic;text-decoration:underline;">"{{$campaign->title}}"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row mt-1">
                                    <div class="col-sm-3">
                                        <h6 style="">Funds Available : </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <h2 style="margin-bottom:0;"> <span style="background-color:greenyellow;border-radius: 10%; padding: 4px 4px;">₱ {{$campaign->available_funds}}</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <p style="text-decoration:underline; margin: 0 0;">Payment Details</p>
                                <h6 style="font-size:10px;"><strong>Instructions : </strong> Please indicate below your bank details. We accept through (Gcash, PayMaya, Remittance Centers, Bank Transfer)</h6><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="amount">Amount (₱) :</label>
                                        <span class="j_tag_trans"></span>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" id="amount" class="form-control" name="amount" placeholder="{{$campaign->available_funds}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="details">Bank Details :</label>
                                        <span class="j_tag_trans"></span>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea name="details" id="details" cols="30" rows="6" class="form-control" placeholder="Bank/ Account No./ Full Name"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="paypal">Contact No. :</label>
                                        <span class="j_tag_trans"></span>
                                    </div>
                                    <div class="col-sm-9">
                                        <input id="paypal" type="text" class="form-control" name="paypal" placeholder="09XXXXXXXXX"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
                <div class="row">
                    <!-- <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <div class="row"> -->
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Claim Funds</button>
                                <a href="{{route('jobseeker.earnings')}}" class="btn btn-danger mb-1 mb-sm-0 mr-0 mr-sm-1">Cancel</a>
                            </div>
                        <!-- </div>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(function() {
        'use strict';

        var formClaim = $('#form-claim');

        formClaim.on('submit', function(e) {
            e.preventDefault();
            $(this).find('button[type=submit]').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                            buttonsStyling: false
                        }).then(function(result) {
                            location.href = "{{route('jobseeker.earnings')}}"
                        });
                    }
                },
                error: function(req, status, err) {
                    Swal.fire({
                        title: 'Failed!',
                        text: req.responseJSON.msg,
                        icon: 'error'
                    });
                    formClaim.find('button[type=submit]').prop('disabled', false);
                }
            })
        });
    })
</script>
@endsection