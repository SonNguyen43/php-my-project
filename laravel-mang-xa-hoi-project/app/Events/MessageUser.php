<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\FriendMessage;

class MessageUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FriendMessage $content)
    {
        $this->content = $content;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        # tên của channal
        # lúc này nó sẽ gửi sự kiện với user có id là thằng đang đăng nhập
        # nếu clien khác active vào user với id là thằng gửi này thì sẽ bắt được sự kiện
        # user.1_to_user.2
        // return PrivateChannel($this->content);
        return new PrivateChannel('user.'.$this->content->user->id.'_to_user.'.$this->content->to_user_id);
    }
}
