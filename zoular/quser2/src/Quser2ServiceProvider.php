<?php

namespace Zoular\Quser2;

use Illuminate\Support\ServiceProvider;
use Zoular\Quser2\Quser2;
use Zoular\Quser2\QuserInterface;

class Quser2ServiceProvider extends ServiceProvider
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
        $this->app->bind(
            QuserInterface::class,
            Quser2::class
        );
    }
}
