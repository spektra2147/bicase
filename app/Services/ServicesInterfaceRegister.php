<?php

namespace App\Services;

use App\Services\Interfaces\ExchangeServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class ServicesInterfaceRegister
{
    /**
     * Register Service dependency injection
     * @return void
     */
    public static function register(): void
    {
        app()->bind(UserServiceInterface::class, UserService::class);
        app()->bind(ExchangeServiceInterface::class, ExchangeService::class);
    }
}
