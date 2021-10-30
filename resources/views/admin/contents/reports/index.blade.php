@extends('admin.layouts.main')
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
@endsection
@section('content')
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body p-0">
                    <img src="{{asset('images/banner.png')}}" class="w-100" alt="Medal Pic" style="height: 180px" />
                </div>
            </div>
        </div>
        <!--/ Medal Card -->

        <!-- Statistics Card -->
        <div class="col-xl-8 col-md-6 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistics</h4>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{$statistics->campaigns}}</h4>
                                    <p class="card-text font-small-3 mb-0">Number of Campaigns</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{$statistics->users}}</h4>
                                    <p class="card-text font-small-3 mb-0">Number of Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{$statistics->services}}</h4>
                                    <p class="card-text font-small-3 mb-0">Number of Services</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="media">
                                <div class="avatar bg-light-success mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{$statistics->donations}}</h4>
                                    <p class="card-text font-small-3 mb-0">Total Donations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>

    <div class="row match-height">
        <div class="col-lg-4 col-12">
            <div class="row match-height">
                <!-- Bar Chart - Orders -->
                <div class="col-lg-6 col-md-3 col-6">
                    <div class="card">
                        <div class="card-body pb-50">
                            <h6>Orders</h6>
                            <h2 class="font-weight-bolder mb-1">{{$statistics->orders}}</h2>
                            <div id="statistics-order-chart"></div>
                        </div>
                    </div>
                </div>
                <!--/ Bar Chart - Orders -->

                <!-- Line Chart - Profit -->
                <div class="col-lg-6 col-md-3 col-6">
                    <div class="card card-tiny-line-stats">
                        <div class="card-body pb-50">
                            <h6>Views</h6>
                            <h2 class="font-weight-bolder mb-1">{{$statistics->views}}</h2>
                            <div id="statistics-profit-chart"></div>
                        </div>
                    </div>
                </div>
                <!--/ Line Chart - Profit -->

                <!-- Earnings Card -->
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="card earnings-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title mb-1">Earnings</h4>
                                    <div class="font-small-2">This Month</div>
                                    <h5 class="mb-1">₱{{$earnings->thismonth}}</h5>
                                    <p class="card-text text-muted font-small-2">
                                        <span class="font-weight-bolder">{{$earnings->difInPercent}}%</span><span> more earnings than last month.</span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div id="earnings-chart" data-value="{{$earnings->difInPercent}}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Earnings Card -->
            </div>
        </div>

        <!-- Revenue Report Card -->
        <div class="col-lg-8 col-12">
            <div class="card card-revenue-budget">
                <div class="row mx-0">
                    <div class="col-12 revenue-report-wrapper">
                        <div class="d-sm-flex justify-content-between align-items-center mb-2">
                            <h4 class="card-title mb-50 mb-sm-0">Top 10 JobSeekers</h4>
                        </div>
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Orders</th>
                                                <th>Earnings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($topjobseekers as $jobseeker)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary mr-1">
                                                            <div class="avatar-content">
                                                                <img src="../../../app-assets/images/avatars/10.png" class="rounded-circle w-100" alt="Toolbar svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">{{$jobseeker->information->firstname}} {{$jobseeker->information->lastname}}</div>
                                                            <div class="font-small-2 text-muted">{{$jobseeker->email}}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">{{$jobseeker->orders}}</span>
                                                    </div>
                                                </td>
                                                <td>₱{{$jobseeker->earnings}}</td>
                                            </tr>
                                            @empty 
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Revenue Report Card -->
    </div>

</section>
@endsection

@section('scripts')
<script src="{{ asset('app-assets/js/scripts/pages/reports.js') }}"></script>
@endsection