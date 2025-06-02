<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification’s delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array<string>
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // Add 'mail' to enable email notifications
    }

    /**
     * Format the notification for email delivery.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = $this->order;

        return (new MailMessage)
            ->subject('New Order Received - #' . $order->id)
            ->greeting('Hello Admin,')
            ->line('A new order has been placed.')
            ->line('Order ID: #' . $order->id)
            ->line('User: ' . ($order->user->name ?? 'Guest'))
            ->line('Game UID: ' . $order->game_uid)
            ->line('Amount: ' . number_format($order->final_price, 2) . ' BDT')
            ->line('Placed at: ' . $order->created_at->toDayDateTimeString())
            ->action('View Order', route('admin.orders.show', $order->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Format the notification for database storage.
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        return [
            'title'     => 'New Order Placed',
            'order_id'  => $this->order->id,
            'user'      => $this->order->user->name ?? 'Guest',
            'amount'    => $this->order->total ?? null,
            'placed_at' => $this->order->created_at->toDateTimeString(),
        ];
    }

    /**
     * Fallback array representation (not used by database or mail).
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return $this->toDatabase($notifiable);
    }
}
