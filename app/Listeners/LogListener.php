<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Log;

class LogListener
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
     * @param  EmailHasConfirmed  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $log = new Log();
        $log->event_id = $event->id;
        $log->user_id = $event->user->id;
        $log->save();
    }
}
