<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SendDailyStats::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Отправляем статистику каждый день в 18:00
        $schedule->command('stats:daily')->dailyAt('18:00');
        
        // Для тестирования - каждую минуту
        // $schedule->command('stats:daily')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}