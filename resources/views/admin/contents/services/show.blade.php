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
                            <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Service Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Service ID : </strong> {{$service_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Service No. : </strong> {{$service_no}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Status : </strong> {{$service_status}}</h6>

                            <h6 class="ml-2" style="font-size:14px;margin-top:20px; font-weight:400;"><strong>Title : </strong> {{$service_title}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Categories : </strong> 
                                @foreach($service_categories as $category)
                                    {{$category->name}} @if(!$loop->last)/@endif
                                @endforeach
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Description : </strong> {{$service_desc}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Price : </strong> {{$service_price}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Duartion : </strong>
                                @if( $service_duration_hours > 1 ) {{$service_duration_hours}} Hrs @elseif( $service_duration_hours == 0 )  @else {{$service_duration_hours}} Hr @endif
                                @if( $service_duration_minutes > 1 ) {{$service_duration_minutes}} Mins @elseif( $service_duration_minutes == 0 )  @else {{$service_duration_minutes}} Min @endif
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Location : </strong> {{$service_location}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Tags : </strong> 
                                @foreach($service_tags as $tag)
                                    {{$tag->name}} @if(!$loop->last)/@endif
                                @endforeach
                            </h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Created Date : </strong> {{$created_date}}</h6>

                            <hr>

                            <h6 style="color:#120a78;margin-bottom:20px;margin-top:20px;font-size:20px;font-weight:bolder;">Jobseeker Details</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>User ID : </strong> {{$user_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Jobseeker ID : </strong> {{$jobseeker_id}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Username : </strong> {{$jobseeker_username}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Firstname : </strong> {{$jobseeker_firstname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Lastname : </strong> {{$jobseeker_lastname}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Email : </strong> {{$jobseeker_email}}</h6>
                            <h6 class="ml-2" style="font-size:14px; font-weight:400;"><strong>Contact : </strong> {{$jobseeker_contact}}</h6>

                            <!-- 'service_id' => $service->id,
                            'service_no' => System::GenerateFormattedId('S', $service->id),
                            'service_title' => $service->title,
                            'service_categories' => $service->categories,
                            'service_desc' => $service->description,
                            'service_price' => $service->price,
                            'service_duration' => $service->duration,
                            'service_location' => $service->location,
                            'service_tags' => $service->tags,
                            'created_date' => date('F d, Y', strtotime($service->created_at)),
                            'service_status' => $service->status,

                            'user_id' => $service->jobseeker->id,
                            'jobseeker_id' => System::GenerateFormattedId('J', $service->jobseeker->id),
                            'jobseeker_username' => $service->jobseeker->username,
                            'jobseeker_firstname' => $service->jobseeker->information->firstname,
                            'jobseeker_lastname' => $service->jobseeker->information->lastname,
                            'jobseeker_email' => $service->jobseeker->email,
                            'jobseeker_contact' => $service->jobseeker->information->phone, -->

                        </div>
                        <!-- Service Details - End -->
                    </div>
                    <!-- Header ends -->
                </div>
                <!-- Invoice Note starts -->

                <!-- Invoice Note ends -->

            </div>

            <!-- Service-Orders Table Start -->
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
                                    <h6 style="color:#120a78;margin-bottom:20px;font-size:20px;font-weight:bolder;">Service-Orders</h6>
                                    <div class="card-datatable table-responsive">
                                        <table class="withdraw-list-table table">
                                        <!-- Order Details

                                        No.
                                        Delivery Date
                                        Location
                                        Payment Method
                                        Customer
                                        Additional Message -->
                                            <thead>
                                                <tr>
                                                    <th>SO ID</th>
                                                    <th>BFN</th>
                                                    <th>BLN</th>
                                                    <th>Delivery Date</th>
                                                    <th>PM</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($orders as $order)
                                                <tr>
                                                    <td>{{System::GenerateFormattedId('SO', $order->id)}}</td>
                                                    <td>{{@$order->backer->information->firstname ?? '-'}}</td>
                                                    <td>{{@$order->backer->information->lastname ?? '-'}}</td>
                                                    <td>{{date('F d, Y', strtotime($order->details->render_date))}}</td>
                                                    <td>{{$order->details->payment_method}}</td>
                                                    <td>
                                                        @if($order->status == 1)
                                                            <span class="badge " style="background-color:lightskyblue">Pending Request</span>
                                                        @elseif($order->status == 2)
                                                            <span class="badge badge-danger">Declined</span> 
                                                        @elseif($order->status == 3)
                                                            <span class="badge badge-primary">Accepted</span>
                                                        @elseif($order->status == 4)
                                                            <span class="badge badge-info" style="background-color:limegreen">Ongoing</span> 
                                                        @elseif($order->status == 5)
                                                            <span class="badge badge-warning">Pending Payment</span>
                                                        @elseif($order->status == 6)
                                                            <span class="badge badge-secondary" style="background-color:darkmagenta">Pending Rating & Feedback</span>
                                                        @elseif($order->status == 7)
                                                            <span class="badge badge-success">Completed</span>
                                                        @elseif($order->status == 8)
                                                            <span class="badge badge-danger" style="background-color:red">Cancelled</span>
                                                        @else
                                                            Error Status !!!
                                                        @endif
                                                    </td>
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
            <!-- Service-Orders Table End -->
        </div>
        <!-- /Invoice -->
    </div>
</section>   
@endsection