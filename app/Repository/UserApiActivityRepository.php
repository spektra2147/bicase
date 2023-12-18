<?php

namespace App\Repository;

use App\Models\UserApiActivity;
use App\Repository\Interfaces\UserApiActivityRepositoryInterface;

class UserApiActivityRepository implements UserApiActivityRepositoryInterface
{
    /**
     * @param UserApiActivity $activity
     * Insert User API Activity Repository
     *
     * @return UserApiActivity
     */
    public function saveActivity(UserApiActivity $activity): UserApiActivity
    {
        $activity->save();

        return $activity;
    }
}
