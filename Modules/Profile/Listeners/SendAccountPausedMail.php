<?php

namespace Modules\Profile\Listeners;

use Modules\Profile\Events\AccountPaused;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Notifications\UserAccountPasueNotification;

class SendAccountPausedMail implements ShouldQueue
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
     * @param AccountPaused $event
     * @return void
     */
    public function handle(AccountPaused $event)
    {
        $event->user->notify(new UserAccountPasueNotification());
    }
}
