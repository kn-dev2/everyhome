<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ExtraServiceRepository;
use App\Service\ExtraServiceClass;

class ExtraServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExtraServiceRepository::class, ExtraServiceClass::class);
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
