<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Helpers\System;
use App\Models\Order;
class OrderPayment extends Notification
{
    use Queueable;

    protected $order;
    protected $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $invoice)
    {
        $this->order = $order;
        $this->invoice = $invoice;
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
        $invoice_id = System::GenerateFormattedId('IO',$this->invoice->id);
        $order = Order::where('id', $this->order->id)->with('service')->first();
        
        if($notifiable->hasAnyRole('JobSeeker')){
            return [
                'heading' => 'Service Order – Payment Successful',
                'text' => "Successfully processed payment for Invoice No.: {$invoice_id} for ' {$order->service->title} ' with No.: {$order_id}. Please proceed to Add Feedback & Rating."
            ];
        }elseif($notifiable->hasAnyRole('Backer')){
            return [
                'heading' => 'Service Order – Payment Successful',
                'text' => "Successfully processed payment for Invoice No.: {$invoice_id} for ' {$order->service->title} ' by {$order->service->jobseeker->username} with No: {$order_id}.  Please proceed to Add Feedback & Rating."
            ];
        }
    }
}
