<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MaidRepository;
use App\Service\MaidClass;

class MaidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MaidRepository::class, MaidClass::class);
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
