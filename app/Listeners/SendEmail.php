<?php

namespace App\Listeners;

use App\Events\UserRegistered;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event): void
    {
        var_dump('sending a welcome email to '.$event->user->email);
    }
}
