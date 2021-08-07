<?php

namespace App\Listeners;

use App\Events\NewBooking;
use App\Mail\NewBookingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Mailable;

class NewBookingListener extends Mailable implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewBooking $event)
    {

        \Mail::to($event->booking->doctor->email)->send(new NewBookingMail($event->booking));
    }
}
