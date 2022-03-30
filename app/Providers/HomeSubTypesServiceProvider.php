<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\HomeSubTypesRepository;
use App\Service\HomeSubTypesClass;

class HomeSubTypesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HomeSubTypesRepository::class, HomeSubTypesClass::class);
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
