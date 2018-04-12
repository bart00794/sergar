<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\VkService',function($app){
            return new VkAuthService();
        });
    }
}
