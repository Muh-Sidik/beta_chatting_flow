<?php

namespace App\Providers;

use App\DetailChat;
use App\Observers\ChatObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // DetailChat::observe(ChatObserver::class);
    }
}
