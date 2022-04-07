<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TimeSlotsRepository;
use App\Service\TimeSlotsClass;

class TimeSlotsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TimeSlotsRepository::class, TimeSlotsClass::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

?>
