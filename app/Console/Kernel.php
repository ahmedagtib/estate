<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\RemoveTemp;
use App\Console\Commands\ScrapManage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        RemoveTemp::class,
        ScrapManage::class

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

        $schedule->command('delete:temp')->weekly();
       // $schedule->command('scrap:start')->dailyAt('00:00');
        //$schedule->command('queue:work')->everyFiveMinutes();
       // $schedule->command('queue:restart')->everyFiveMinutes();

         $schedule->command('scrap:start')->everyMinute();
         $schedule->command('queue:work')->everyMinute();
         $schedule->command('queue:restart')->everyMinute();


       
   
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
