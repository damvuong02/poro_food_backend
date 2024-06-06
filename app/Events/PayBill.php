<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayBill implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data = $data; // Khởi tạo thuộc tính với dữ liệu được truyền vào
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('pay-bill'),
        ];
    }
    public function broadcastAs()
    {
        return 'pay-bill';
    }

    public function broadcastWith()
    {
        return ['data' => $this->data]; // Trả về dữ liệu cho event
    }
}
