@extends('landing.layouts.main')

@section('content')
<div class="events_section layout_padding_campaignspage">
    <div class="container">
       <div class="row mb-2">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">CAMPAIGNS</h1>
          </div>
          <div class="col-sm-12">
            <div class="row">
                <div class="col-md-8 d-flex justify-content-start">
                      <div class="dropdown dropdown-category mr-1">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Category
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              @foreach($categories as $category)
                              <a class="dropdown-item" href="#" data-value="{{$category->id}}">{{$category->name}}</a>
                              @endforeach
                          </div>
                      </div>
                      <div class="dropdown dropdown-type mr-1">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Type
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                               <a class="dropdown-item" href="#" data-value="all">All</a>
                               <a class="dropdown-item" href="#" data-value="latest">Latest</a>
                               <a class="dropdown-item" href="#" data-value="popular">Popular</a>
                          </div>
                      </div>
                      <div class="dropdown dropdown-region mr-1">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Region
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                              <a class="dropdown-item" href="#">All</a>
                          </div>
                      </div>
                </div>
                <div class="col-md-4 d-flex">
                    <input type="text" name="filter_search" class="form-control" placeholder="Search">
                    <button type="button" class="btn btn-default btn-search"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
          </div>
       </div>
       <div class="row">
            @forelse($campaigns as $campaign)
                <div class="col-md-3 pt-4">
                    <div class="campaign_tile" style="box-shadow: 0 0.5rem 1.5rem 0 #e4dede;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="img_7"><a href="{{route('campaign_view', $campaign->id)}}"><img style="width: 100%; height: 200px; object-fit: cover;" src="{{$campaign->thumbnail_url != '' ? $campaign->thumbnail_url : asset('app-assets/images/pages/no-image.png')}}" class="img_7"></a></div>
                                <!-- <div class="date_bt">
                                    <div class="date_text active"><a href="#">{{date('d', strtotime($campaign->target_date))}}</a></div>
                                    <div class="date_text"><a href="#">{{date('M', strtotime($campaign->target_date))}}</a></div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <h1 class="give_taital_1 overflow-ellipsis"><a href="{{route('campaign_view', $campaign->id)}}">{{$campaign->title}}</a></h1>
                                <p class="ipsum_text_1 ">{{$campaign->description}}</p>
                                <div>
                                    <p class="ipsum_text_1">Category</p>
                                </div>
                                <div>
                                    <p class="ipsum_text_1">Target Date: {{date('M-d', strtotime($campaign->target_date))}}</p>
                                </div>
                                <div class="progress-wrapper progress_bar_campaigns">
                                    <div id="example-caption-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6>Php {{$campaign->progress->current_value}} <br>Raised</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 style="text-align: right;">Php {{$campaign->progress->target_value}} <br>Target</h6>
                                            </div>
                                            <!-- <div class="col-6">Php {{$campaign->progress->target_value}} <br>Target</div> -->
                                        </div>
                                    </div>
                                    <div class="progress progress-bar-primary">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->progress->current_value}}" aria-valuemin="0" 
                                            aria-valuemax="{{$campaign->progress->target_value}}" style="width: {{$campaign->progress->percentage}}%" 
                                            aria-describedby="example-caption-2">
                                        </div>
                                    </div>
                                </div><!-- <div class="donate_btn_main">
                                    <div class="donate_btn_1"><a href="{{route('campaign_view', $campaign->id)}}" class="donate_btn" data-campaign-id="{{$campaign->id}}">Donate Now</a></div>
                                </div> -->
                                <!-- <div class="donate_btn_main">
                                    <div class="donate_btn_1"><a href="{{route('campaign_view', $campaign->id)}}">Donate Now</a></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            @empty 
            @endforelse
        </div> 
    </div>
</div>    
@endsection

@section('modals')
<div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Donation</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('campaign.donate')}}" class="donation_form">
            @csrf
            <input type="hidden" name="campaign_id">
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2 class="campaign-title"></h2>
                    </div>
                </div>
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 class="card-title">Your Info</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">Firstname</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Lastname</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" name="email_address" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_anonymous" value="1" id="disableUserInfoInputs">
                                    <label class="form-check-label" for="disableUserInfoInputs">
                                        Would you like to donate anonymously?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="php">PHP</option>
                                        <option value="usd">USD</option>
                                    </select>
                                    <input type="number" name="amount" step=".01" placeholder="Amount in PHP/USD" class="form-control" required>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message to Jobseeker/Campaign (optional)</label>
                                    <textarea name="message" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Transaction Fee</h5>
                                <h5>Payment Processing Fee</h5>
                                <h5><strong>Total Amount</strong></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>5%</h5>
                                <h5>3%</h5>
                                <h5 class="total_amount"></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Donate Now!</button>
            </div>
        </form>
      </div>
    </div>
</div>    
<div class="modal fade" id="selectPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:400px" role="document">
      <div class="modal-content">
        <div class="loader"></div>
        <div class="card card-payment text-center hide">
          <div class="card-header pb-0">
            <h2 class="card-title"></h2>
          </div>
          <div class="card-body">
              <h3 class="topay"></h3>
              <div class="links">
                <div id="paypal-button"></div>
              </div>
              <p class="mt-1">or</p>
              <button type="button" id="pay-by-card">
                <span id="button-text">Pay with Card</span>
              </button>
              <form id="payment-form" class="stripe-payment d-none">
                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                <button id="submit">
                  <div class="spinner hidden" id="spinner"></div>
                  <span id="button-text">Pay</span>
                </button>
                <p id="card-error" role="alert"></p>
                <p class="result-message hidden">
                  Payment succeeded, see the result in your
                  <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                </p>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function(){
        'use strict'
        var dropdownCategory = $('.dropdown-category'),
            dropdownType = $('.dropdown-type'),
            dropdownRegion = $('.dropdown-region'),
            btnSearch = $('.btn-search');

        var filter = {
            category: param('category'),
            type: param('type'),
            region: param('region'),
            search: param('search')
        };

        loadFilterDefault();

        dropdownCategory.on('click', '.dropdown-item', function(){
            dropdownCategory.find('.dropdown-toggle').text($(this).text());
            filter.category = $(this).data('value');
            searchFilter(filter);
        });
        dropdownType.on('click', '.dropdown-item', function(){
            dropdownType.find('.dropdown-toggle').text($(this).text());
            filter.type = $(this).data('value');
            searchFilter(filter);
        });
        dropdownRegion.on('click', '.dropdown-item', function(){
            dropdownRegion.find('.dropdown-toggle').text($(this).text());
            filter.type = $(this).data('value');
            searchFilter(filter);
        });
        btnSearch.on('click', function(){
            filter.search = $('input[name=filter_search]').val();
            searchFilter(filter);
        });

        function loadFilterDefault(){
            if(filter.category != ''){
                var text = dropdownCategory.find('a[data-value='+filter.category+']').text();
                dropdownCategory.find('.dropdown-toggle').text(text);
            }
                
            if(filter.type != ''){
                var text = dropdownType.find('a[data-value='+filter.type+']').text();
                dropdownType.find('.dropdown-toggle').text(text);
            }
                
            if(filter.region != ''){
                var text = dropdownRegion.find('a[data-value='+filter.region+']').text();
                dropdownRegion.find('.dropdown-toggle').text(text);
            }
                
            if(filter.search != ''){
                $('input[name=filter_search]').val(filter.search);
            }
                
            
        }
        function searchFilter(filter){
            var params = [];
            var domain = window.location.origin;
            if(filter.category != ''){
                params.push('category='+filter.category);
            }
            if(filter.type != ''){
                params.push('type='+filter.type);
            }
            if(filter.region != ''){
                params.push('region='+filter.region);
            }
            if(filter.search != ''){
                params.push('search='+filter.search);
            }

            var newUrl = domain+'/campaigns?'+params.join('&');
            window.location.href = newUrl;
        }

        function param(name) {
            return (location.search.split(name + '=')[1] || '').split('&')[0];
        }
    });
</script>
@endsection