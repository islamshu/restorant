<?php

namespace App\Listeners;

use App\Events\OrderAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderAddedListener
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
     * @param  \App\Events\OrderAdded  $event
     * @return void
     */
    public function handle(OrderAdded $event)
    {
        //
    }
}
