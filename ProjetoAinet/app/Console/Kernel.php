<?php

namespace App\Console;

use App\Http\Middleware\IsBloqueado;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
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

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'IsBloqueado' => \App\Http\Middleware\IsBloqueado::class,
        'isCliente' => \App\Http\Middleware\IsCliente::class,
    ];
}
