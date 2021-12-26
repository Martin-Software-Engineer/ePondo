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
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
<!-- 
    id
    price
    add_charges
    date_due
    created_at
    updated_at
    order_id
    transaction_fee
    processing_fee
    total
    status
-->
    <section class="create-campaign-wrapper">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{route('admin.invoice.update', $invoice->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="invoice-id">Invoice ID</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="invoice-id" class="form-control" name="invoice_id" value="{{$invoice->id}}"  disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="invoice-no">Invoice No.</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="invoice-no" class="form-control" name="invoice_no" value="{{System::GenerateFormattedId('I', $invoice->id),}}"  disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="order-id"> Order ID</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="order-id" class="form-control" name="order_id" value="{{$invoice->order_id}}"  disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="order-no">Order No.</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="order-no" class="form-control" name="order_no" value="{{System::GenerateFormattedId('SO', $invoice->order_id),}}"  disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="price">Price</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="price" step=".01" id="price" class="form-control" value="{{$invoice->price}}" placeholder="00" aria-label="Amount (to the nearest peso)" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="add-charges">Added Charges</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="add_charges" step=".01" id="add-charges" class="form-control" value="{{$invoice->add_charges}}" placeholder="00" aria-label="Amount (to the nearest peso)" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="transaction-fee">Transaction Fee</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="transaction_fee" step=".01" id="transaction-fee" class="form-control" value="{{$invoice->transaction_fee}}" placeholder="00" aria-label="Amount (to the nearest peso)" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="processing-fee">Processing Fee</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="processing_fee" step=".01" id="processing-fee" class="form-control" value="{{$invoice->processing_fee}}" placeholder="00" aria-label="Amount (to the nearest peso)" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="total">Total</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                <input type="number" name="total" step=".01" id="total" class="form-control" value="{{$invoice->total}}" placeholder="00" aria-label="Amount (to the nearest peso)" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="date-due">Date Due</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="date" name="date_due" id="date-due" value="{{$invoice->date_due}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="created-at">created_at</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="created-at" class="form-control" name="created_at" value="{{$invoice->created_at}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="updated-at">updated_at</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="updated-at" class="form-control" name="updated_at" value="{{$invoice->updated_at}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="status">Status</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="status" id="status" class="form-control">
                                                @for($i = 1; $i<=4; $i++)
                                                <option value="{{$i}}"  @if($i == $invoice->status) selected @endif  >
                                                    {{$i}}
                                                    @if($i== 1)Ongoing 
                                                    @elseif($i== 2)Pending Payment
                                                    @elseif($i== 3)Paid
                                                    @elseif($i== 4)Cancelled
                                                    @endif
                                                </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
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
            'use strict'

            var form = $('form');

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
                                icon: 'success',
                                confirmButtonText: 'Invoices List',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                },
                                buttonsStyling: false
                            }).then(function(result) {
                                location.href = "{{route('admin.invoice.index')}}"
                            });
                        }
                    }
                });
            });

            $('.select2').each(function() {
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