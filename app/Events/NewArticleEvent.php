<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewArticleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $article;

    public function __construct($article)
    {
        $this->article = $article;
    }

    public function broadcastOn()
    {
        return new Channel('test');
    }

    public function broadcastWith()
    {
        return [
            'article' => [
                'id' => $this->article->id,
                'name' => $this->article->title,
                'title' => $this->article->title
            ]
        ];
    }
}