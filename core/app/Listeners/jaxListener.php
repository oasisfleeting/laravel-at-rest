<?php

namespace App\Listeners;

use App\Events\jaxEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class jaxListener
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
     * @param  jaxEvent  $event
     * @return void
     */
    public function handle(jaxEvent $event)
    {
        //
    }
}
