<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SettingRepository;
use App\Service\SettingClass;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SettingRepository::class, SettingClass::class);
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
