<?php

namespace App\Providers;

use App\Repositories\ApiContactRepository;
use App\Repositories\ContactRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ContactRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactRepositoryInterface::class, ApiContactRepository::class);
    }
}
