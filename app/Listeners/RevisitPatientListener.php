<?php

namespace App\Listeners;

use App\Mail\PatientRevisitMail;
use App\Events\RevisitPatientEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Mailable;

class RevisitPatientListener extends Mailable implements ShouldQueue
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
    public function handle(RevisitPatientEvent $event)
    {
        \Mail::to($event->booking->patient->email)->send(new PatientRevisitMail($event->booking));
    }
}
