<?php

namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Inquiry $inquiry)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Portfolio Inquiry from ' . $this->inquiry->name)
                    ->greeting('Hello Charles,')
                    ->line('You have received a new message through your portfolio website.')
                    ->line('')
                    ->line('**Contact Details:**')
                    ->line('Name: ' . $this->inquiry->name)
                    ->line('Email: ' . $this->inquiry->email)
                    ->line('')
                    ->line('**Message:**')
                    ->line($this->inquiry->message)
                    ->line('')
                    ->line('**Submitted:** ' . $this->inquiry->created_at->format('F j, Y \a\t g:i A'))
                    ->line('')
                    ->line('You can reply directly to ' . $this->inquiry->email . ' to respond to this inquiry.')
                    ->salutation('Regards, Portfolio Notification System');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'inquiry_id' => $this->inquiry->id,
            'name' => $this->inquiry->name,
            'email' => $this->inquiry->email,
        ];
    }
}
