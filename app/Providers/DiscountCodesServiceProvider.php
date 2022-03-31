<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\DiscountCodesRepository;
use App\Service\DiscountCodesClass;

class DiscountCodesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DiscountCodesRepository::class, DiscountCodesClass::class);
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
