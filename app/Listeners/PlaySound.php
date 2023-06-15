<?php

namespace App\Listeners;

use App\Events\NewDatabaseEntry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlaySound
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
     * @param  \App\Events\NewDatabaseEntry  $event
     * @return void
     */
    public function handle(NewDatabaseEntry $event)
{
    // Play the sound using Laravel Echo and Vue.js
    // Replace 'your-sound.mp3' with the path to your sound file
    event(new \Illuminate\Broadcasting\Channel('new-database-entry'))
        ->whisper('new-database-entry', ['sound' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3']);
}
}
