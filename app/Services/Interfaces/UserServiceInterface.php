<?php

namespace App\Services\Interfaces;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

interface UserServiceInterface
{
    /**
     * @param RegisterRequest $request
     * Register User Service
     *
     * @return object
     */
    public function register(RegisterRequest $request): object;

    /**
     * Login User Service
     *
     * @param LoginRequest $request
     *
     * @return object
     */
    public function login(LoginRequest $request): object;
}
