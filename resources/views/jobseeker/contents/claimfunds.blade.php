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
            <h4 class="card-title">Claim Funds for <b>{{$campaign->title}}</b></h4>
        </div>
        <div class="card-body">
            <form class="form-validate" id="form-claim" action="{{route('jobseeker.funds.claim')}}" method="POST">
                @csrf 
                <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
                <div class="row">
                    <div class="col-md-8">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Claim Funds</button>
                        <a href="{{route('jobseeker.earnings')}}" class="btn btn-secondary mb-1 mb-sm-0 mr-0 mr-sm-1">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>    
@endsection

@section('scripts')
<script>
    $(function(){
        'use strict';

        var formClaim = $('#form-claim');

        formClaim.on('submit', function(e){
            e.preventDefault();
            $(this).find('button[type=submit]').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            location.reload();
                        });
                    }
                },
                error: function(req, status, err){
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