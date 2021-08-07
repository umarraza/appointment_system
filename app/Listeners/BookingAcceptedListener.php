<?php

namespace App\Listeners;

use Illuminate\Mail\Mailable;
use App\Events\BookingAccepted;
use App\Mail\BookingAcceptedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingAcceptedListener extends Mailable implements ShouldQueue
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
    public function handle(BookingAccepted $event)
    {
        \Mail::to($event->booking->patient->email)->send(new BookingAcceptedMail($event->booking));
    }
}
