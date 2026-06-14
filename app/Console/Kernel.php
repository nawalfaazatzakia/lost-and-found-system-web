<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Register custom Artisan commands here
    ];

    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        // Define scheduled tasks here
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
