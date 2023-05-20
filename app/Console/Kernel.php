<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\PotentialPropertyCron::class,
        Commands\CompetitorPropertyCron::class,
        Commands\PointsOfInterestCron::class,
        Commands\REITsCron::class,
        Commands\PopulationCron::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('telescope:prune')->daily();
        $schedule->command('potential_property_google:cron')
            ->everyMinute();
        $schedule->command('competitor_property_google:cron')
            ->everyMinute();
        $schedule->command('points_of_interest:cron')
            ->everyMinute();
        $schedule->command('reits_google:cron')
            ->everyMinute();
        $schedule->command('populations:cron')
            ->weekly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
