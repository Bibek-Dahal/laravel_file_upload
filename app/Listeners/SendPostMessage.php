<?php

namespace App\Listeners;

use App\Events\PostSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostMessage
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
     * @param  \App\Events\PostSaved  $event
     * @return void
     */
    public function handle(PostSaved $event)
    {
        // dd ($event->post->title,$event->post->description);
    }
}
