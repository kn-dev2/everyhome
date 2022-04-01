<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookingRepository;
use App\Service\BookingClass;

class BookingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookingRepository::class, BookingClass::class);
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
