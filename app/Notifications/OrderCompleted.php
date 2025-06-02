<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCompleted extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // Channels to send notification
    public function via($notifiable)
    {
        return ['database']; // Add 'mail' if you want email notifications
    }

    // Data stored in notifications table
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Your order #' . $this->order->id . ' has been completed successfully!',
        ];
    }

    // Optional email notification (enable by adding 'mail' to via())
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Order Completed')
                    ->line('Your order #' . $this->order->id . ' is completed.')
                    ->action('View Order', url('/orders/' . $this->order->id))
                    ->line('Thank you for shopping with us!');
    }
}
