<?php

namespace App\Console;

use App\Services\AllServices;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendDailyReminderEmail;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//        $schedule->command(SendDailyReminderEmail::class)->timezone('Asia/Jakarta')->dailyAt('17:39');

        $schedule->call(function () {
            AllServices::sendDailyReminder();
        })->dailyAt('17:46');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
