<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewArticleNotification extends Notification
{
    use Queueable;

    public function __construct(private Article $article)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'article_id' => $this->article->id,
            'title' => $this->article->title,
            'author' => $this->article->user->name,
            'message' => 'Опубликована новая статья: ' . $this->article->title,
            'url' => '/articles/' . $this->article->id,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}