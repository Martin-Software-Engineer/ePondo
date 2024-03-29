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
    .avatar .avatar-content{
        width: 60px;
        height: 60px;
    }
    .avatar .avatar-content .avatar-icon{
        height: 2rem;
        width: 2rem;
    }
</style>
@endsection

@section('content')
<ul class="nav nav-pills" style="border-bottom:darkblue;">
    <li class="nav-item">
        <a class="nav-link active" id="service-tab" data-toggle="pill" href="#service" aria-expanded="true">Service Earnings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="campaign-tab" data-toggle="pill" href="#campaign" aria-expanded="false">Campaign Funds</a>
    </li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="service" aria-labelledby="service-tab" aria-expanded="true">
        <section>
            <div class="row mb-2">
                <div class="col-md-9">
                    <h2 class="float-left mb-0">Earnings</h2>
                </div>
                <div class="col-md-3">
                    @if($service_earnings['available'] > 0) 
                        <button type="button" class="float-right btn btn-primary btn-round" data-toggle="modal" data-target="#withdraw-modal">Withdraw Available Earnings</button>
                    @endif
                </div>
            </div>
        </section>
        <section>
            <div class="row">
            <!-- col-xl-3 col-md-3 col-sm-6 -->
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4 mb-2 mb-md-0">
                                <div class="avatar bg-light-primary rounded">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$service_earnings['earnings']}}</h2>
                            <p class="card-text mb-0">Total Earnings</p>
                            <h6 class="j_tag_trans">(Kabuuang Kita)</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-primary rounded">
                                    <div class="avatar-content">
                                        <i data-feather="gift" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$service_earnings['rewards']}}</h2>
                                <p class="card-text mb-0">Total Rewards</p>
                                <h6 class="j_tag_trans">(Kabuuang Gantimpala)</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-primary rounded">
                                    <div class="avatar-content">
                                        <i data-feather="share" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$service_earnings['withdrawn']}}</h2>
                                <p class="card-text mb-0">Withdrawn</p>
                                <h6 class="j_tag_trans">(Nakuhang Kita)</h6>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-primary rounded">
                                    <div class="avatar-content">
                                        <i data-feather="clock" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$service_earnings['pendings']}}</h2>
                                <p class="card-text mb-0">Pending</p>
                                <h6 class="j_tag_trans" style="font-size:9px;">(Nakabinbing Kinukuhang Kita)</h6> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-primary rounded">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$service_earnings['available']}}</h2>
                                <p class="card-text mb-0">Available Earnings</p>
                                <h6 class="j_tag_trans" style="font-size:9px;">(Hindi pa nakukuhang Kita)</h6>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="card">
            <div class="card-body">
                <section class="withdraw-list-wrapper">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" id="earnings-tab" data-toggle="pill" href="#earnings" aria-expanded="false">Earnings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rewards-tab" data-toggle="pill" href="#rewards" aria-expanded="true">Rewards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="withdrawals-tab" data-toggle="pill" href="#withdrawals" aria-expanded="true">Withdrawal History</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="earnings" role="tabpanel" aria-labelledby="earnings-tab" aria-expanded="false">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="withdraw-list-table table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Jobseeker</th>
                                                <th>Backer</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($service_earnings['history'] as $history)
                                            <tr>
                                                <td>{{$history->created_at->format('M d, Y')}}</td>
                                                <td>{{System::GenerateFormattedId('I', $history->id)}}</td>
                                                <td>{{$history->order->service->jobseeker->information->lastname}}, {{$history->order->service->jobseeker->information->firstname}}</td>
                                                <td>{{$history->order->backer->information->lastname}}, {{$history->order->backer->information->firstname}}</td>
                                                <td>₱{{$history->price}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center"><h3>No Records Found</h3></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="rewards" aria-labelledby="rewards-tab" aria-expanded="true">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="withdraw-list-table table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Order ID</th>
                                                <th>Service</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($service_rewards as $reward)
                                            <tr>
                                                <td>{{$reward->created_at->format('M d, Y')}}</td>
                                                <td>{{System::GenerateFormattedId('S', $reward->order->id)}}</td>
                                                <td>{{$reward->order->service->title}}</td>
                                                <td>₱{{$reward->amount}}</td>
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
                        </div>
                        <div role="tabpanel" class="tab-pane" id="withdrawals" aria-labelledby="withdrawals-tab" aria-expanded="true">
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
                                            @forelse($service_earnings['payouts'] as $payout)
                                            <tr>
                                                <td>{{$payout->created_at->format('M d, Y')}}</td>
                                                <td>{{$payout->for}}</td>
                                                <td>₱{{$payout->amount}}</td>
                                                <td>
                                                    @if($payout->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($payout->status == 'paid')
                                                        <span class="badge badge-success">Paid</span>
                                                    @elseif($payout->status == 'denied')
                                                        <span class="badge badge-danger">Denied</span>
                                                    @endif
                                                </td>
                                                
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
                        </div>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="campaign" aria-labelledby="campaign-tab" aria-expanded="true">
        <section>
            <div class="row mb-2">
                <div class="col-md-9">
                    <h2 class="float-left mb-0">Funds</h2>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-success rounded">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$campaign_funds['totalfunds']}}</h2>
                                <p class="card-text mb-0">Total Funds</p>
                                <h6 class="j_tag_trans">(Kabuuang Pondo)</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-success rounded">
                                    <div class="avatar-content">
                                        <i data-feather="share" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$campaign_funds['claimed']}}</h2>
                                <p class="card-text mb-0">Withdrawn</p>
                                <h6 class="j_tag_trans">(Nakuhang Pondo)</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4 mb-2 mb-md-0">
                                <div class="avatar bg-light-success rounded">
                                    <div class="avatar-content">
                                        <i data-feather="clock" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$campaign_funds['pendings']}}</h2>
                                <p class="card-text mb-0">Pending</p>
                                <h6 class="j_tag_trans" style="font-size:8px;">(Nakabinbing Kinukuhang Pondo)</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body row">
                            <div class="col-12 col-md-4  mb-2 mb-md-0">
                                <div class="avatar bg-light-success rounded">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <h2 class="font-weight-bolder">₱{{$campaign_funds['available']}}</h2>
                                <p class="card-text mb-0">Available Funds</p>
                                <h6 class="j_tag_trans" style="font-size:8px;">(Hindi pa nakukuhang Pondo)</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="card">
            <div class="card-body">
                <section class="withdraw-list-wrapper">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" id="campaigns-tab" data-toggle="pill" href="#campaigns" aria-expanded="false">Campaigns</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link " id="claimed-tab" data-toggle="pill" href="#claimed" aria-expanded="true">Withdrawal History</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="campaigns" role="tabpanel" aria-labelledby="campaigns-tab" aria-expanded="false">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="withdraw-list-table table">
                                        <thead>
                                            <tr>
                                                <th>Campaign</th>
                                                <th>Funds Raised</th>
                                                <th>Funds Claimed</th>
                                                <th>Funds Pending</th>
                                                <th>Funds Available</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($campaign_funds['campaigns'] as $campaign)
                                            <tr>
                                                <td>{{$campaign->title}}</td>
                                                <td>₱{{$campaign->raised}}</td>
                                                <td>₱{{$campaign->claimed}}</td>
                                                <td>₱{{$campaign->pending}}</td>
                                                <td>₱{{$campaign->available_funds}}</td>
                                                <td>
                                                    @if($campaign->available_funds > 0)
                                                        <a href="{{route('jobseeker.funds.claimform', $campaign->id)}}" class="btn btn-sm btn-primary">Withdraw Available Funds</a>
                                                    @else 
                                                        <button disabled class="btn btn-sm btn-warning">Claimed</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center"><h3>No Records Found</h3></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="claimed" aria-labelledby="claimed-tab" aria-expanded="true">
                            <div class="card">
                                <div class="table-responsive">
                                    <div class="card-datatable table-responsive">
                                        <table class="withdraw-list-table table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($campaign_funds['claimed_requests'] as $crequest)
                                                <tr>
                                                    <td>{{$crequest->created_at}}</td>
                                                    <td>{{$crequest->campaign->title}}</td>
                                                    <td>₱{{$crequest->amount}}</td>
                                                    <td>
                                                        @if($crequest->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif($crequest->status == 'paid')
                                                            <span class="badge badge-success">Paid</span>
                                                        @elseif($crequest->status == 'denied')
                                                            <span class="badge badge-danger">Denied</span>
                                                        @endif
                                                    </td>
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
                            </div>
                        </div>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
   

@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="withdraw-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" style="text-align:center; align-items:center;">Withdraw Available - Service Earnings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('jobseeker.earnings.withdraw')}}" method="POST">
                    @csrf
                    <input type="hidden" name="amount" value="{{$service_earnings['available']}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h2 style="margin: 15px 0;"> <span style="background-color:greenyellow;border-radius: 10%; padding: 4px 4px;">₱ {{$service_earnings['available']}}</span></h2>
                                    <p style="margin: 0 0;text-decoration:underline;">Payment Details</p>
                                    <h6 style="font-size:10px;margin-top:10px;"><strong>Instructions : </strong> Please indicate below your bank details. We accept through Gcash, PayMaya, Remittance Centers, Bank Transfer.</h6>
                                    <h6 style="font-size:10px;font-style:italic;font-weight:100;margin-top:0;">(Paalala na ilagay sa ilalaim ang mga detalye ng iyong banko)</h6>
                                    <textarea name="details" id="details" cols="30" rows="5" class="form-control" placeholder="Bank/ Account No./ Full Name/ Contact No."></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
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
            form = withdrawModal.find('form');
            $(this).find('button[type=submit]').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                beforeSend: function() {
                    form.find('button[type=submit]').prop('disabled', true);
                    form.find('.invalid-feedback').remove();
                    form.find('.valid-feedback').remove();
                    form.find('.invalid-feedback.valid-feedback').remove();
                    form.find('input').removeClass('is-invalid');
                    form.find('textarea').removeClass('is-invalid');
                },
                success: function(resp){
                    form.find('button[type=submit]').prop('disabled', false);
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
                error: function(xhr, status, error){
                    $.each(xhr.responseJSON.errors, function(name, error){
                        form.find('button[type=submit]').prop('disabled', false);
                        form.find('#'+name).siblings('.invalid-feedback').remove();
                        form.find('#'+name).siblings('.valid-feedback').remove();
                        form.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        form.find('#'+name).addClass('is-invalid');
                        form.find('#'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                        </div>
                        `);
                    });
                }
            });
        });
    })
</script>
@endsection