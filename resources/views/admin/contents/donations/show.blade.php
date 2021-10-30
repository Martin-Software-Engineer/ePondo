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
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Donation Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Donation ID : </strong> {{$donation_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Donation No. : </strong> {{$donation_no}}</h6>
                            <h6 class="ml-2" style="font-size:14px;margin-top:20px; font-weight:400;"><strong>Backer First Name : </strong> {{$backer_firstname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Backer Last Name : </strong> {{$backer_lastname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Email : </strong> {{$backer_email}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Amount : </strong> Php {{$donation_amount}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Message : </strong> {{$donation_message}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Date : </strong> {{$donation_date}}</h6>

                            <hr>
                            @foreach($campaigns as $campaign)
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Campaign Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Campaign ID : </strong> {{$campaign->id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Campaign No. : </strong> {{System::GenerateFormattedId('C', $campaign->id)}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Status : </strong> 
                                @if($campaign->status ==1 )
                                Ongoing
                                @elseif($campaign->status ==2 )
                                Pending Payment
                                @else
                                Error
                                @endif
                            </h6>
                
                            <h6 class="ml-2" style="font-size:14px;margin-top:20px; font-weight:400;"><strong>Title : </strong> {{$campaign->title}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Category : </strong>
                                @foreach($campaign->categories as $category)
                                    {{$category->name}} @if(!$loop->last)/@endif
                                @endforeach
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Description : </strong> {{$campaign->description}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Created Date : </strong> {{date('F d, Y', strtotime($campaign->created_at))}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Target Date : </strong> {{$campaign->target_date}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Target Amount : </strong> Php {{$campaign->target_amount}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Raised Amount : </strong> Php {{$campaign->donations()->sum('amount')}}</h6>
                            
                            @endforeach
                            
                            
                            
                            
                            
                            <!-- <th>CD ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Amount</th> -->


                        </div>
                        <!-- Service Details - End -->
                    </div>
                    <!-- Header ends -->
                </div>
                <!-- Invoice Note starts -->

                <!-- Invoice Note ends -->
            </div>
        </div>
        <!-- /Invoice -->
    </div>
</section>   
@endsection