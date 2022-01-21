<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Auth\Events\AccountSwitched;
use Modules\Auth\Events\UserRegistered;
use Modules\Auth\Listeners\SendAccountActivationMail;
use Modules\Auth\Listeners\SendAccountSwitchedMail;
use Modules\Auth\Listeners\SendWelcomeMail;
use Modules\Profile\Events\AccountPaused;
use Modules\Profile\Listeners\SendAccountPausedMail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            SendWelcomeMail::class,
            SendAccountActivationMail::class
        ],
        AccountPaused::class => [
            SendAccountPausedMail::class,
        ],
        AccountSwitched::class => [
            SendAccountSwitchedMail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
