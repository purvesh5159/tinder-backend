<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        // run daily; change to hourly if you prefer
        $schedule->command('check:popular-users')->daily();
    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}