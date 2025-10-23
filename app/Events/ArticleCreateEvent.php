<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class NewArticleEvent implements ShouldBroadcast {
    public $article;
    public function __construct($article) { $this->article = $article; }
    public function broadcastOn() { return new Channel('test'); }
    public function broadcastWith() {
        return ['article' => [
            'id' => $this->article->id,
            'name' => $this->article->title,
            'title' => $this->article->title
        ]];
    }
}