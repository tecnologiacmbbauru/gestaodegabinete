<?php

namespace App\Listeners;

use App\Events\EventName;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerName
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
     * @param  EventName  $event
     * @return void
     */
    public function handle(EventName $event)
    {
        //
    }
}
