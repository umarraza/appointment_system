<?php

namespace App\Http\Controllers;

use App\User;
use App\SlotBooking;
use App\PatientSummary;
use Illuminate\Http\Request;

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
}
