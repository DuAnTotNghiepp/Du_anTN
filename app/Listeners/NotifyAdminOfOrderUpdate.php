<?php

namespace App\Listeners;

use App\Events\OrderUpdated;
use App\Models\User;
use App\Notifications\OrderUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyAdminOfOrderUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderUpdated $event): void
    {
        $order = $event->order;
    
        // Lấy danh sách admin
        $admins = User::where('role', 'admin')->get();
    
        // Kiểm tra và gửi thông báo
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new OrderUpdatedNotification($order));
        } else {
            Log::warning('Không tìm thấy admin để gửi thông báo.');
        }
    }
}
