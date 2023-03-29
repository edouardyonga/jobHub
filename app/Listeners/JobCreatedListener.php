<?php

namespace App\Listeners;

use App\Events\JobCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JobCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JobCreatedEvent $event): void
    {
        dd($event->job->title . ' Have been created!!');
    }
}
