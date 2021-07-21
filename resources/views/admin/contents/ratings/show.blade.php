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

@section('content')
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <!-- <div class="col-md-12"> -->
        <div class="col-xl-9 col-md-8 col-12">          
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0 mb-0">
                        <!-- Service Details - Start -->
                        <div class="col">
                            
                            <h6 style="color:#120a78;margin-bottom:30px;border-bottom: 3px solid #120a78;">Service Order No. : <b>{{$order_id}}</b> </h6>
                            <h6>Title : <span style="font-style:italic;"> {{$rating->order->service->title}}</span> </h6>
                            @switch($rating->from)
                                @case('backer')
                                 <h6>From : <span>{{$rating->order->backer->username}}</span></h6>
                                @break

                                @case('jobseeker')
                                    <h6>From : <span>{{$rating->order->service->jobseeker->username}}</span></h6>
                                @break
                            @endswitch
                            @if($rating->rating > 0)
                            <div class="s_image">
                                @for($i = 0; $i < $rating->rating; $i++)
                                <img class="s_image_star" src="{{asset('app-assets/images/additional_pictures/star_1.png')}}">
                                @endfor
                                ({{$rating->rating}})
                            </div>
                            @endif

                        </div>
                        <!-- Service Details - End -->
                    </div>
                    <!-- Header ends -->
                </div>
                <hr/>
                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="col">
                        <h6 class="mt-2">Feedback: {{$rating->feedback}}</h6>
                    </div>
                </div>
                <!-- Invoice Note ends -->
            </div>
        </div>
        <!-- /Invoice -->


    </div>
</section>   
@endsection  
