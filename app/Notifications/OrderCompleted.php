<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Helpers\System;
use App\Models\Order;
class OrderCompleted extends Notification
{
    use Queueable;

    protected $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $order_id = System::GenerateFormattedId('SO',$this->order->id);
        $order = Order::where('id', $this->order->id)->with('service')->first();
        $jobseeker_name = $order->service->jobseeker->information->firstname.' '.$order->service->jobseeker->information->lastname;

        if($notifiable->hasAnyRole('JobSeeker')){
            return [
                'heading' => 'Service Order - Submitted Complete',
                'text' => "Successfully Submitted Complete Service Order for ' {$order->service->title} ' with No.: {$order_id}"
            ];
        }elseif($notifiable->hasAnyRole('Backer')){
            return [
                'heading' => 'Service Order – Submitted Complete',
                'text' => "Successfully Submitted Complete Service Order for ' {$order->service->title} ' by {$jobseeker_name} with No.: {$order_id}. 
                           Please proceed to View Invoice & Process Payment."
            ];
        }
    }
}
