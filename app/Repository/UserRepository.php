<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * Insert User Repository
     *
     * @return User
     */
    public function register(User $user): User
    {
        $user->save();

        return $user;
    }

    /**
     * @param Authenticatable $auth
     * Generate new Token by User Repository
     *
     * @return string
     */
    public function generateToken(Authenticatable $auth): string
    {
            return $auth->createToken('bicase')->plainTextToken;
    }
}
