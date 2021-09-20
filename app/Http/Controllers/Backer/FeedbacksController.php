<?php

namespace App\Http\Controllers\Backer;

use App\Models\User;
use App\Models\Order;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Models\Feedback;
use App\Helpers\GiveReward;;
use Illuminate\Http\Request;
use App\Models\ServiceRating;
use App\Models\FeedbackPlatform;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderFeedback as OrderFeedbackNotification;
use App\Notifications\OrderFinish as OrderFinishNotification;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'service_feedback' => 'required'
        ]);

        $order = Order::find($request->order_id);

        $rating = $order->ratings()->create([
            'service_id' => $request->service_id,
            'rating' => $request->service_rating,
            'feedback' => $request->service_feedback,
            'from' => $request->from
        ]);
        
        Feedback::create([
            'service_id' => $request->service_id,
            'message' => $request->service_feedback,
            'from' => $request->from
        ]);

        FeedbackPlatform::create([
            'service_id' => $request->service_id,
            'rating' => $request->platform_rating,
            'message' => $request->platform_message,
            'from' => $request->from,
            'service_rating_id' => $rating->id
        ]);

        $jobseeker = User::find($order->service->user_id);
        $backer = User::find($order->backer->id);

        $backer->notify(new OrderFeedbackNotification($order));

        Mail::to($backer->email)->queue(new SendMail('emails.order-feedback-mail', [
            'subject' => 'Successful Service Order Feedback',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));

        //Change SO status to Complete if both Jobseeker & Backer have Feedback
        if(ServiceRating::where('order_id', $order->id)->where('from', 'jobseeker')->exists()){ 
            $totalorders = Order::whereHas('service', function($q) use($jobseeker){
                $q->where('user_id', $jobseeker->id);
            })->where('status',7)->count(); //Counter for Reward Points
    
            //Reward Points
            if($totalorders <= 0){ //first time
                $reward = new GiveReward($jobseeker->id, 'receiving_1st_service_order_rf');
                $reward->send();
                $reward2 = new GiveReward(auth()->user()->id, 'creating_1st_service_order_feedback');
                $reward2->send();
            }else{
                $reward = new GiveReward($jobseeker->id, 'receiving_service_order_rf');
                $reward->send();
                $reward2 = new GiveReward(auth()->user()->id, 'creating_service_order_feedback');
                $reward2->send();
            }

            $order->status = 7;
            $order->save();

            $backer->notify(new OrderFinishNotification($order));
            $jobseeker->notify(new OrderFinishNotification($order));

            Mail::to($backer->email)->queue(new SendMail('emails.backer.order-complete-mail', [
                'subject' => 'Congratulations Service Order Complete!',
                'order_id' => System::GenerateFormattedId('S', $order->id)
            ]));
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-complete-mail', [
                'subject' => 'Congratulations Service Order Complete!',
                'order_id' => System::GenerateFormattedId('S', $order->id)
            ]));

        }

        return response()->json(['success' => true, 'msg' => 'Feedback Submitted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
