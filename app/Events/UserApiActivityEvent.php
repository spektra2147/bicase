<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Queue\SerializesModels;

class UserApiActivityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public FormRequest $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FormRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return FormRequest
     *
     * Return request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
