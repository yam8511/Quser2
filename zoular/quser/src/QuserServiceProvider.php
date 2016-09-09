<?php

namespace Zoular\Quser;

use Illuminate\Support\ServiceProvider;
use Zoular\Quser\Quser;
use Zoular\Quser\QuserInterface;

class QuserServiceProvider extends ServiceProvider
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
            Quser::class
        );
    }
}
