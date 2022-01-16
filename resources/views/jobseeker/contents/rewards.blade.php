@extends('jobseeker.layouts.main')
@section('css')
<style>
    .reward-star {
        width: 50%;
    }

    .current-star {
        width: 10%;
    }

    .progress {
        height: 1.5rem;
    }

    .progress {
        width: 100%;
    }

    .current-star-description {
        position: absolute;
        bottom: 10px;
    }
</style>
@endsection
@section('content')
<section>
    <div class="row">
        <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
            <div class="row">
                <div class="col-md-10">
                    <h2>Rewards</h2>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-start align-items-center">
                            <img src="{{asset('app-assets/images/reward/'.$badge)}}" class="current-star" />
                            <div class="progress progress-bar-primary ml-1">
                                
                                @if($current_points < 1000)
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$progress->current}}" aria-valuemin="{{$progress->min}}" aria-valuemax="{{$progress->max}}" style="width: {{($progress->current/$progress->max)*100}}%">
                                        {{$progress->current}} / {{$progress->max}} pts
                                    </div>
                                    <div class="current-star-description">Earn {{$progress->req}} pts to reach {{$next_tier}} tier</div>
                                @else 
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$progress->current}}" aria-valuemin="{{$progress->current}}" aria-valuemax="{{$progress->current}}" style="width: 100%">
                                    {{$progress->current}} pts
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h1 class="mt-3 mb-3">Rewards Tier Breakdown</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{asset('app-assets/images/reward/star-silver.png')}}" class="reward-star mb-2" alt="svg img" />
                            <h1>SILVER</h1>
                            <h5 class="text-secondary">POINTS REQUIRED: <br> 100-499 POINTS</h5>
                            <br><br>
                            <h5 class="text-secondary"><b>EARN ADDITIONAL</b></h5>
                            <h2 class="text-secondary">+0.6%</h2>
                            <h5 class="text-secondary">PER SERVICE</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{asset('app-assets/images/reward/star-gold.png')}}" class="reward-star mb-2" alt="svg img" />
                            <h1>GOLD</h1>
                            <h5 class="text-warning">POINTS REQUIRED: <br> 500-999 POINTS</h5>
                            <br><br>
                            <h5 class="text-warning"><b>EARN ADDITIONAL</b></h5>
                            <h2 class="text-warning">+1.2%</h2>
                            <h5 class="text-warning">PER SERVICE</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{asset('app-assets/images/reward/star-platinum.png')}}" class="reward-star mb-2" alt="svg img" />
                            <h1>PLATINUM</h1>
                            <h5 class="text-success">POINTS REQUIRED: <br> 1000+ POINTS</h5>
                            <br><br>
                            <h5 class="text-success"><b>EARN ADDITIONAL</b></h5>
                            <h2 class="text-success">+2.0%</h2>
                            <h5 class="text-success">PER SERVICE</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Points History</h4>
                        </div>
                        <div class="" style="position: relative;height: 200px;overflow: auto;display: block;">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rewards as $reward)
                                    <tr>
                                        <td>{{date('F d, Y', strtotime($reward->pivot->created_at))}}</td>
                                        <!-- <td>{{$reward->created_at}}</td> -->
                                        <td>{{$reward->actions}}</td>
                                        <td>{{$reward->points}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection