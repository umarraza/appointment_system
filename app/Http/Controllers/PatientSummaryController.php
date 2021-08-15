<?php

namespace App\Http\Controllers;

use App\User;
use App\SlotBooking;
use App\PatientSummary;
use Illuminate\Http\Request;
use App\Events\RevisitPatientEvent;

class PatientSummaryController extends Controller
{
    public function create(User $patient)
    {
        return view('frontend.patients.summary.create', compact('patient'));
    }

    public function index(Request $request)
    {
        $patient = User::find($request->id);
        return view('frontend.patients.summary.index', compact('patient'));
    }

    public function store(Request $request, User $patient)
    {
        $booking = $patient->patientAppointments->last();

        $activity = PatientSummary::updateOrCreate(['patient_id' => $patient->id],[
            'patient_id'        => $patient->id,
            'booking_id'        => $booking->id,
            'revisit'           => $request->has('revisit') ? 1 : 0,
            'medicine_details'  => $request->medication,
            'allergies'         => $request->allergies,
            'reason_of_visit'   => $request->reason_of_visit,
        ]);

        return redirect()->route('doctor.appointments.booked');
    }

    public function show(SlotBooking $booking)
    {
        $patient = $booking->patient;

        return view('frontend.patients.summary', compact('patient', 'booking'));
    }

    public function edit(SlotBooking $booking)
    {
        $summary = PatientSummary::where('booking_id', $booking->id)->first();
        
        return view('frontend.patients.summary.edit', compact('booking', 'summary'));
    }

    public function update(Request $request, SlotBooking $booking)
    {
        if ($booking->summary()->exists())
        {
            $booking->summary->update([
                'medicine_details'  => $request->medication,
                'allergies'  => $request->allergies,
                'reason_of_visit'  => $request->reason_of_visit,
                'revisit'  => $request->has('revisit') ? 1 : 0,
            ]);
        } else
        {
            PatientSummary::create([
                'patient_id'        => $booking->patient->id,
                'booking_id'        => $booking->id,
                'medicine_details'  => $request->medication,
                'allergies'         => $request->allergies,
                'reason_of_visit'   => $request->reason_of_visit,
                'revisit'           => $request->has('revisit') ? 1 : 0,
            ]);
        }


        if ($request->revisit == 'on')
        {
            event(new RevisitPatientEvent($booking));
        }

        return redirect()->route('patient.summary.show', $booking->id);
    }
}
