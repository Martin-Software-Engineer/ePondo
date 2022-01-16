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
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Rewards Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>ID : </strong> {{$user}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Name : </strong> {{$name}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Total Points : </strong> {{$total}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Rewards Tier : </strong> {{$reward_tier}}</h6>
                        </div>
                        <!-- Service Details - End -->
                    </div>
                    <!-- Header ends -->
                </div>
            </div>


            <!-- Donations Table Start -->
            <div class="card">
                <div class="card-body">
                    <section class="withdraw-list-wrapper">
                        <div class="tab-content">
                            <div class="tab-pane active" id="campaigns" role="tabpanel" aria-labelledby="campaigns-tab" aria-expanded="false">
                                <div class="card">
                                    <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Donations</h6>
                                    <div class="card-datatable table-responsive">
                                        <table class="withdraw-list-table table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Points</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($rewards as $reward)
                                                <tr>
                                                    <td>{{date('F d, Y', strtotime($reward->pivot->created_at))}}</td>
                                                    <td>{{$reward->actions}}</td>
                                                    <td>{{$reward->points}}</td>
                                                    <td></td>
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