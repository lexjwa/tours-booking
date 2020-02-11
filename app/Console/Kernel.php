<?php

namespace App\Console;

use App\Console\Commands\DayAfterDay;
use App\Console\Commands\monthly;
use App\Console\Commands\weekly;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DayAfterDay::class,
        monthly::class,
        weekly::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cron:day-afterday')->dailyAt('13:00');
        $schedule->command('cron:weekly')->weekly();
        $schedule->command('cron:email-monthly')->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
