<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\HomeTypesRepository;
use App\Service\HomeTypesClass;

class HomeTypesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HomeTypesRepository::class, HomeTypesClass::class);
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
