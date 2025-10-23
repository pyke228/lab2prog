<?php

namespace App\Jobs;

use App\Models\Article;
use App\Mail\NewArticleMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle()
    {
        // Имитируем долгую задачу
        sleep(10);
        
        // Отправляем email
        Mail::to('pyk2288@mail.ru')->send(new NewArticleMail($this->article));
    }
}