@extends('jobseeker.layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
<style>
    .table-campaign-title{
        white-space: nowrap;
        overflow: hidden;
    }
    th { font-size: 12px; }
    td { font-size: 12px; }
</style>
@endsection

@section('content')
<section>
    <div class="row mb-2">
        <div class="col-md-9">
            <h2 class="float-left mb-0">Earnings</h2>
        </div>
        <div class="col-md-3">
            @if($available > 0) 
                <button type="button" class="float-right btn btn-primary btn-round" data-toggle="modal" data-target="#withdraw-modal">Withdraw Available Balance</button>
            @endif
        </div>
    </div>
</section>
<div class="row">
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="font-weight-bolder">₱{{$earnings}}</h2>
                <p class="card-text">Earnings</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="font-weight-bolder">₱{{$withdrawn}}</h2>
                <p class="card-text">Withdrawn</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="font-weight-bolder">₱{{$pendings}}</h2>
                <p class="card-text">Pendings</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="font-weight-bolder">{{$available}}</h2>
                <p class="card-text">Available Balance</p>
            </div>
        </div>
    </div>
</div>
<section class="withdraw-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="withdraw-list-table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>For</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                    <tr>
                        <td>{{$payout->created_at->format('M d, Y')}}</td>
                        <td>{{$payout->for}}</td>
                        <td>₱{{$payout->amount}}</td>
                        <td>{{$payout->status}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center"><h3>No Records Found</h3></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>      
@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="withdraw-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Your about to withdraw ₱{{$available}} balance from your earnings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('jobseeker.earnings.withdraw')}}" method="POST">
                    @csrf
                    <input type="hidden" name="amount" value="{{$available}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="details">Payment Details</label>
                                    <textarea name="details" id="details" cols="30" rows="5" class="form-control" placeholder="Bank or Paypal Details"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
@endsection

@section('external_js')
<script src="{{asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endsection
@section('scripts')
<script>
    $(function(){
        'user strict';

        var withdrawModal = $('#withdraw-modal');

        withdrawModal.on('submit', 'form', function(e){
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
                }
            });
        });
    })
</script>
@endsection