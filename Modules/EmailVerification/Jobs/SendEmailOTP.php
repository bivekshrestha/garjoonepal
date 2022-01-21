<?php

namespace Modules\EmailVerification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\EmailVerification\Entities\Verifiable;
use Modules\EmailVerification\Notifications\EmailOTP;

class SendEmailOTP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $verifiable;

    /**
     * Create a new job instance.
     *
     * @param Verifiable $verifiable
     */
    public function __construct(Verifiable $verifiable)
    {
        $this->verifiable = $verifiable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->verifiable->notify(new EmailOTP());
    }
}
