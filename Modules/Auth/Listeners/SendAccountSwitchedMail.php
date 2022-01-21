<?php

namespace Modules\Auth\Listeners;

use Modules\Auth\Events\AccountSwitched;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Auth\Notifications\BusinessAccountCreated;

class SendAccountSwitchedMail implements ShouldQueue
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
     * @param AccountSwitched $event
     * @return void
     */
    public function handle(AccountSwitched $event)
    {
        $event->user->notify(new BusinessAccountCreated());
    }
}
