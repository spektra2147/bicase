<?php

namespace App\Repository\Interfaces;

use App\Models\UserApiActivity;

interface UserApiActivityRepositoryInterface
{
    /**
     * @param UserApiActivity $activity
     * Insert User API Activity Repository
     *
     * @return UserApiActivity
     */
    public function saveActivity(UserApiActivity $activity): UserApiActivity;
}
