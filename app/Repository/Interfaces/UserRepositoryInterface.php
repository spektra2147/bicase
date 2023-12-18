<?php

namespace App\Repository\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * Insert User Repository
     *
     * @return User
     */
    public function register(User $user): User;

    /**
     * Generate new Token by User Repository
     *
     * @param Authenticatable $auth
     *
     * @return string
     */
    public function generateToken(Authenticatable $auth): string;
}
