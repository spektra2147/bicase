<?php

namespace App\Providers;

use App\Repository\RepositoryInterfaceRegister;
use App\Services\ServicesInterfaceRegister;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        RepositoryInterfaceRegister::register();
        ServicesInterfaceRegister::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
