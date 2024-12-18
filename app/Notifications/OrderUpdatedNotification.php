<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderUpdatedNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail']; // Gửi thông báo qua email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Trạng thái đơn hàng đã được cập nhật.')
                    ->action('Xem chi tiết', url('/orders/' . $this->order->id))
                    ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!');
    }
}
