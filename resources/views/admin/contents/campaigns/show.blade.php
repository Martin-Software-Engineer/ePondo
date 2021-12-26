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
<style>
    .table-campaign-title{
        white-space: nowrap;
        overflow: hidden;
    }
    th { font-size: 12px; }
    td { font-size: 12px; }
</style>
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection
@section('content')
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-3">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0 mb-0">
                        <!-- Service Details - Start -->
                        <div class="col">
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Campaign Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Campaign ID : </strong> {{$campaign_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Campaign No. : </strong> {{$campaign_no}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Status : </strong> 
                                @if($campaign_status ==1 )
                                Ongoing
                                @elseif($campaign_status ==2 )
                                Pending Payment
                                @else
                                Error
                                @endif
                            </h6>
                
                            <h6 class="ml-2" style="font-size:14px;margin-top:20px; font-weight:400;"><strong>Title : </strong> {{$campaign_title}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Category : </strong>
                                @foreach($campaign_categories as $category)
                                    {{$category->name}} @if(!$loop->last)/@endif
                                @endforeach
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Description : </strong> {{$campaign_desc}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Created Date : </strong> {{$created_date}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Target Date : </strong> {{$target_date}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Target Amount : </strong> Php {{$target_amount}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Raised Amount : </strong> Php {{$raised_amount}}</h6>
                            
                            <!-- 'campaign_id' => $campaign->id,
            'campaign_no' => System::GenerateFormattedId('C', $campaign->id),
            'campaign_title' => $campaign->title,
            'campaign_categories' => $campaign->categories,
            'campaign_desc' => $campaign->description,
            'created_date' => date('F d, Y', strtotime($campaign->created_at)),
            'target_date' => date('F d, Y', strtotime($campaign->target_date)),
            'target_amount' => $campaign->target_amount,
            'raised_amount' => $campaign->donations()->sum('amount'),

            'jobseeker_id' => System::GenerateFormattedId('C', $campaign->jobseeker->id),
            'jobseeker_username' => $campaign->jobseeker->username,
            'jobseeker_firstname' => $campaign->jobseeker->information->firstname,
            'jobseeker_lastname' => $campaign->jobseeker->information->lastname,
            'jobseeker_email' => $campaign->jobseeker->email -->
                            <hr>

                            <h6 style="color:#120a78;margin-bottom:20px;margin-top:20px;font-size:20px;font-weight:bolder;">Jobseeker Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>User ID : </strong> {{$user_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Jobseeker ID : </strong> {{$jobseeker_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Username : </strong> {{$jobseeker_username}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Firstname : </strong> {{$jobseeker_firstname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Lastname : </strong> {{$jobseeker_lastname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Email : </strong> {{$jobseeker_email}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Contact : </strong> {{$jobseeker_contact}}</h6>


                        </div>
                        <!-- Service Details - End -->
                    </div>
                    <!-- Header ends -->
                </div>
                <!-- Invoice Note starts -->

                <!-- Invoice Note ends -->
            </div>
            
            <!-- Donations Table Start -->
            <div class="card">
                <div class="card-body">
                    <section class="withdraw-list-wrapper">
                        <!-- <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" id="campaigns-tab" data-toggle="pill" href="#campaigns" aria-expanded="false">Campaigns</a>
                            </li>    
                            <li class="nav-item">
                                <a class="nav-link " id="claimed-tab" data-toggle="pill" href="#claimed" aria-expanded="true">Withdrawal History</a>
                            </li>
                            
                        </ul> -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="campaigns" role="tabpanel" aria-labelledby="campaigns-tab" aria-expanded="false">
                                <div class="card">
                                    <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Donations</h6>
                                    <div class="card-datatable table-responsive">
                                        <table class="withdraw-list-table table">
                                            <thead>
                                                <tr>
                                                    <th>CD ID</th>
                                                    <th>FN</th>
                                                    <th>LN</th>
                                                    <th>Message</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($donations as $donation)
                                                <tr>
                                                    <td>{{System::GenerateFormattedId('CD', $donation->id)}}</td>
                                                    <td>{{@$donation->backer->information->firstname ?? '-'}}</td>
                                                    <td>{{@$donation->backer->information->lastname ?? '-'}}</td>
                                                    <td>{{$donation->message}}</td>
                                                    <td>₱{{$donation->amount}}</td>
                                                    <td>{{date('F d, Y', strtotime($donation->created_at))}}</td>
                                                    <!-- 'id' => $this->id,
                                                    'donation_id' => System::GenerateFormattedId('CD', $this->id),
                                                    'backer_firstname' => @$this->backer->information->firstname ?? '-',
                                                    'backer_lastname' => @$this->backer->information->lastname ?? '-',
                                                    'backer_email' => @$this->backer->email ?? '-',
                                                    'message' => $this->message,
                                                    'amount' => $this->amount -->
                                                    <td>
                                                        
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center"><h3>No Records Found</h3></td>
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
            <!-- Donations Table End -->
        </div>
        <!-- /Invoice -->
    </div>
</section>   
@endsection