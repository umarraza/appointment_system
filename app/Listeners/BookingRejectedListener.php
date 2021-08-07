<?php

namespace App\Listeners;

use Illuminate\Mail\Mailable;
use App\Events\BookingRejected;
use App\Mail\BookingRejectedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingRejectedListener extends Mailable implements ShouldQueue
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
    public function handle(BookingRejected $event)
    {
        \Mail::to($event->booking->patient->email)->send(new BookingRejectedMail($event->booking));
    }
}
