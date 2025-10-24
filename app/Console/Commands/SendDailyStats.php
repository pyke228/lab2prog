<?php

namespace App\Console\Commands;

use App\Models\ArticleView;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyStats extends Command
{
    protected $signature = 'stats:daily';
    protected $description = 'Send daily statistics to moderators';

    public function handle()
    {
        $today = now()->format('Y-m-d');
        
        try {
            $articleViewsCount = ArticleView::whereDate('created_at', $today)->count();
        } catch (\Exception $e) {
            $articleViewsCount = 0;
            $this->warn('Article views table not found, using 0');
        }
        
        try {
            $newCommentsCount = Comment::whereDate('created_at', $today)->count();
        } catch (\Exception $e) {
            $newCommentsCount = 0;
            $this->warn('Comments table not found, using 0');
        }
        
        try {
            $moderators = User::whereHas('roles', function($query) {
                $query->where('name', 'moderator');
            })->get();
        } catch (\Exception $e) {
 
            $moderators = User::take(1)->get();
            $this->warn('Using fallback moderators');
        }

        if ($moderators->isEmpty()) {
            $moderator = User::first();
            if (!$moderator) {
                $this->error('No users found! Please run db:seed first.');
                return;
            }
            $moderators = collect([$moderator]);
        }

        $stats = [
            'date' => $today,
            'article_views' => $articleViewsCount,
            'new_comments' => $newCommentsCount,
            'total_moderators' => $moderators->count(),
        ];

        foreach ($moderators as $moderator) {
            try {
                Mail::send('emails.daily_stats', $stats, function($message) use ($moderator, $today) {
                    $message->to($moderator->email)
                            ->subject('Ежедневная статистика сайта - ' . $today);
                });
                
                $this->info("Sent to: {$moderator->email}");
            } catch (\Exception $e) {
                $this->error("Failed to send to: {$moderator->email} - {$e->getMessage()}");
            }
        }

        $this->info("Daily statistics sent to {$moderators->count()} moderators");
        $this->info("Stats: {$articleViewsCount} views, {$newCommentsCount} comments");
    }
}