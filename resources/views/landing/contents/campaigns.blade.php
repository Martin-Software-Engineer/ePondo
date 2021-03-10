@extends('landing.layouts.main')

@section('content')
<div class="events_section layout_padding">
    <div class="container">
       <div class="row">
          <div class="col-sm-12 d-flex justify-content-start align-items-center">
             <h1 class="news_taital">CAMPAIGNS</h1>
          </div>
          <div class="col-sm-12">
              <div class="row">
                  <div class="col-md-8 d-flex justify-content-start">
                        <div class="form-group mx-1">
                          <select name="category" id="" class="form-control">
                              <option value="">Category</option>
                          </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="type" id="" class="form-control">
                                <option value="">Type</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="region" id="" class="form-control">
                                <option value="">Region</option>
                            </select>
                        </div>
                  </div>
                  <div class="col-md-4">
                      <input type="text" class="form-control" placeholder="Search">
                  </div>
              </div>
          </div>
       </div>
       <div class="row">
            @forelse($campaigns as $campaign)
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img_7"><img src="{{$campaign->thumbnail_url}}" class="img_7"></div>
                            <div class="date_bt">
                                <div class="date_text active"><a href="#">{{date('d', strtotime($campaign->target_date))}}</a></div>
                                <div class="date_text"><a href="#">{{date('M', strtotime($campaign->target_date))}}</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="give_taital_1">{{$campaign->title}}</h1>
                            <p class="ipsum_text_1">{{$campaign->description}}</p>
                            <h5 class="raised_text_1">Raised: ₱{{$campaign->donations()->sum('amount')}} <br><span class="text-danger">Goal: ₱{{$campaign->target_amount}}</span></h5>
                            <div class="donate_btn_main">
                                <div class="donate_btn_1"><a href="javascript:void(0)" class="donate_btn" data-campaign-id="{{$campaign->id}}">Donate Now</a></div>
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
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Lastname</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
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
                                <input type="number" name="amount" step=".01" placeholder="Amount in PHP/USD" class="form-control">
                            </div>
                        </div>   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Select Payment Method</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                      PayPal
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                    Credit Card
                                    </label>
                                  </div>
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
                        </div>
                        <div class="col-md-6">
                            <h5>5%</h5>
                            <h5>3%</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="total"><strong>Total Amount</strong></label>
                            <input type="number" step=".01" style="display: none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block">Donate Now!</button>
        </div>
      </div>
    </div>
  </div>    
@endsection

@section('scripts')
    <script>
        $(function(){
            'use strict'

            var donateModal = $('#donateModal');

            $('.donate_btn').on('click', async function(){
                var campaignId = $(this).data('campaignId');
                const campaign = await $.get(`/campaign/${campaignId}/details`);
                donateModal.find('.campaign-title').text(campaign.title);

                donateModal.modal('show');
            });

        });
    </script>
@endsection