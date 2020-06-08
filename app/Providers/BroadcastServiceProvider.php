<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Broadcast::routes();
        Broadcast::routes(['prefix' => app()->getLocale(), 'middleware' => ['web', 'auth']]);

        require base_path('routes/channels.php');
    }
}
