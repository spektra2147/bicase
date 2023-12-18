<?php

namespace App\Repository;

use App\Repository\Interfaces\ExchangeRepositoryInterface;
use App\Repository\Interfaces\UserApiActivityRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;

class RepositoryInterfaceRegister
{
    /**
     * Register Service dependency injection
     * @return void
     */
    public static function register(): void
    {
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(ExchangeRepositoryInterface::class, ExchangeRepository::class);
        app()->bind(UserApiActivityRepositoryInterface::class, UserApiActivityRepository::class);
    }
}
