<?php

namespace App\Listeners;

use App\Events\UserRegistered;

final class SendEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     */
    public function handle(UserRegistered $event): void
    {
        var_dump('sending a welcome email to '.$event->getUser()->email);
    }
}
