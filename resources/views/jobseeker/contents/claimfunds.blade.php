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
        </div>
        <div class="card-body">
            <form class="form-validate" id="form-claim" action="{{route('jobseeker.funds.claim')}}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
                <div class="row">
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
                                <h6 style="font-size:10px;margin-top:10px;"><strong>Instructions : </strong> Please indicate below the amount you would like to withdraw and your bank details. We accept through Gcash, PayMaya, Remittance Centers, Bank Transfer. (Paalala na ilagay sa ilalaim ang halaga na nais kunin mula sa pondo at ang mga detalye ng iyong banko)</h6><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="amount">Amount ₱ :<span class="j_tag_trans"><br>(Halaga)</span></label>
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
                                        <label for="details">Bank Details :<span class="j_tag_trans"><br>(Detalye ng Banko)</span></label>
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
                                        <label for="contact">Contact No. :</label>
                                        <span class="j_tag_trans"></span>
                                    </div>
                                    <div class="col-sm-9">
                                        <input id="contact" type="text" class="form-control" name="contact" placeholder="09XXXXXXXXX"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Submit Request</button>
                        <a href="{{route('jobseeker.earnings')}}" class="btn btn-danger mb-1 mb-sm-0 mr-0 mr-sm-1">Cancel</a>
                    </div>
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
                beforeSend: function() {
                    formClaim.find('button[type=submit]').prop('disabled', true);
                    formClaim.find('.invalid-feedback').remove();
                    formClaim.find('.valid-feedback').remove();
                    formClaim.find('.invalid-feedback.valid-feedback').remove();
                    formClaim.find('input').removeClass('is-invalid');
                    formClaim.find('textarea').removeClass('is-invalid');
                },
                success: function(resp) {
                    formClaim.find('button[type=submit]').prop('disabled', false);
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
                error: function(xhr, status, error){
                    $.each(xhr.responseJSON.errors, function(name, error){
                        formClaim.find('button[type=submit]').prop('disabled', false);
                        formClaim.find('#'+name).siblings('.invalid-feedback').remove();
                        formClaim.find('#'+name).siblings('.valid-feedback').remove();
                        formClaim.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        formClaim.find('#'+name).addClass('is-invalid');
                        formClaim.find('#'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                        </div>
                        `);
                    });
                }
            })
        });
    })
</script>
@endsection