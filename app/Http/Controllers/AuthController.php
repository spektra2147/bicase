<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\UserServiceInterface;

class AuthController extends Controller
{
    private UserServiceInterface $userService;

    /**
     * AuthController Construct
     *
     * @param UserServiceInterface $userServiceInterface
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return object
     */
    public function register(RegisterRequest $request): object
    {
        return $this->userService->register($request);
    }

    /**
     * @param LoginRequest $request
     *
     * @return object
     */
    public function login(LoginRequest $request): object
    {
        return $this->userService->login($request);
    }
}
