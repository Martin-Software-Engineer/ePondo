<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonateCampaign extends Notification
{
    use Queueable;

    protected $donator;
    protected $campaign;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($donator, $campaign)
    {
        $this->donator = $donator;
        $this->campaign = $campaign;
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
        if($this->donator->hasAnyRole('JobSeeker')){
            if($this->donator != null){
                return [
                    'heading' => 'Donate Campaign',
                    'text' => "You received a donation from {$this->donator->username} for {$this->campaign->title}. Pls check your campaign for more details"
                ];
            }else{
                return [
                    'heading' => 'Donate Campaign',
                    'text' => "You received a donation for {$this->campaign->title}. Pls check your campaign for more details"
                ];
            }
        }

        if($this->donator->hasAnyRole('Backer')){
            return [
                'heading' => 'Donate Campaign',
                'text' => "Successfully Donated to {$this->campaign->title}."
            ];
        }
        
        return [];
    }
}
