<?php

namespace App\Listeners;

use App\Events\UserApiActivityEvent;
use App\Models\UserApiActivity;
use App\Repository\Interfaces\UserApiActivityRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SaveUserApiActivity
{
    private UserApiActivityRepositoryInterface $userApiActivityRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserApiActivityRepositoryInterface $userApiActivityRepositoryInterface)
    {
        $this->userApiActivityRepository = $userApiActivityRepositoryInterface;
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\UserApiActivityEvent $event
     * @return void
     */
    public function handle(UserApiActivityEvent $event)
    {
        $request = $event->getRequest();

        $userApiActivity = new UserApiActivity();
        $userApiActivity->setAttribute('endpoint_url', $request->path());
//        $userApiActivity->setAttribute('parameters', json_encode($request->all()));
        $userApiActivity->setAttribute('user_id', Auth::id());

        $this->userApiActivityRepository->saveActivity($userApiActivity);
    }
}
