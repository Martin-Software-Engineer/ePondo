@extends('admin.layouts.main')

@section('external_css')
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
@section('content')
<section>
    <div class="row mb-2">
        <div class="col-md-9">
            <h2 class="float-left mb-0">Payout Request</h2>
        </div>
    </div>
</section>
    <section class="create-campaign-wrapper">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{route('admin.payouts.updatestatus', $payout->id)}}" method="POST"> 
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label>Request From:</label>
                                </div>
                                <div class="col-sm-9">
                                    <input class="form-control" value="{{$payout->user->information->lastname}}, {{$payout->user->information->firstname}} ({{$payout->user->email}})" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label>Request Amount:</label>
                                </div>
                                <div class="col-sm-9">
                                    <input class="form-control" value="₱{{$payout->amount}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label>Details:</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control" cols="6" rows="10" disabled>{{$payout->details}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label>Status:</label>
                                </div>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        <option value="pending" @if($payout->status == 'pending') selected @endif>Pending</option>
                                        <option value="paid" @if($payout->status == 'paid') selected @endif>Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
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
            'use strict';

            var form = $('form');
            form.on('submit', function(e){
                e.preventDefault();

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
                    }
                });
            })

        })
    </script>
@endsection