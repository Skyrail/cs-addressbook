<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use App\Services\ChurchSuiteService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ChurchSuiteServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the ChurchSuiteService with the app.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ChurchSuiteService::class, function ($app) {
            return new ChurchSuiteService(Config::get('services')['churchsuite']);
        });
    }
        
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ChurchSuiteService::class];
    }
}
