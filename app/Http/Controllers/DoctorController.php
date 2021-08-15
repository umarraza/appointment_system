<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Profile;
use App\TimeSlot;
use App\SlotBooking;
use App\Events\NewBooking;
use Illuminate\Http\Request;
use App\Events\BookingAccepted;
use App\Events\BookingRejected;

class DoctorController extends Controller
{
    public function patientsList()
    {
        $patients = SlotBooking::where('doctor_id', auth()->user()->id)->distinct()->pluck('patient_id');

        $patients = User::whereIn('id', $patients)->get();
        return view('backend.doctors.patients', compact('patients'));
    }

    public function appointments()
    {
        $appointments = auth()->user()->doctorAppointments->where('status', 'pending');

        return view('backend.doctors.appointments', compact('appointments'));
    }

    public function bookedAppointments()
    {
        $appointments = auth()->user()->doctorAppointments->where('status', 'approved');

        return view('backend.doctors.appointments', compact('appointments'));
    }

    public function canceledAppointments()
    {
        $appointments = auth()->user()->doctorAppointments->where('status', 'rejected');

        return view('backend.doctors.appointments', compact('appointments'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {

            $doctors = User::join('profiles as profile', 'profile.user_id', '=', 'users.id')
                ->where('profile.specialisation', 'LIKE', '%' . $request->get('specialisation') . '%')
                ->where('users.role','=', 'Doctor')
                ->get();
                
            return view('backend.doctors')
                ->withDoctors($doctors);
        }
    }

    public function show(Profile $profile)
    {
        $slots = $profile->user->slots;
        return view('backend.doctors.show', compact('slots'));
    }

    public function bookSlot(Request $request)
    {
        DB::beginTransaction();
        try {

            if ($request->ajax())
            {

                $booking = SlotBooking::where('patient_id', auth()->user()->id)
                    ->whereDate('date', now())
                    ->where('doctor_id', $request->doctor_id)
                    ->where('start_time', $request->start_time)
                    ->first();
                

                if ($booking)
                {
                    return response()->json(['warning' => 'Request has already been sent for this slot!']);
                }

                $slot = TimeSlot::find($request->slot_id);
    
                $booking = SlotBooking::create([
                    'date'          => now(),
                    'patient_id'    => auth()->user()->id,
                    'doctor_id'     => $request->doctor_id,
                    'slot_id'       => $request->slot_id,
                    'start_time'    => $slot->start_time,
                    'end_time'      => $slot->end_time,
                    'status'        => 'pending',
                ]);

                event(new NewBooking($booking));

                $slot->update(['status' => 'pending']);

                DB::commit();

                return response()->json(['success' => 'Your request has been successfully submitted and is being processed!']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong, internal server error!']);
        }
    }

    public function acceptBooking(Request $request)
    {
        DB::beginTransaction();
        try {

            if ($request->ajax()) {
            
                $booking = SlotBooking::find($request->id);
                
                $booking->update([
                    'status' => 'approved'
                ]);

                $slot = TimeSlot::where('doctor_id', $booking->doctor_id)
                    ->where('date', $booking->date)
                    ->where('start_time', $booking->start_time)
                    ->first();

                $slot->update(['status' => 'booked']);

                event(new BookingAccepted($booking));
            }

            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong, internal server error!']);
        }
    }

    public function rejectBooking(Request $request)
    {
        DB::beginTransaction();
        try {

            if ($request->ajax()) {
            
                $booking = SlotBooking::find($request->id);

                $booking->update([
                    'status' => 'rejected'
                ]);
    
                $slot = TimeSlot::where('doctor_id', $booking->doctor_id)
                    ->where('date', $booking->date)
                    ->where('start_time', $booking->start_time)
                    ->first();

                $slot->update(['status' => 'available']);

                event(new BookingRejected($booking));
            }

            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong, internal server error!']);
        }
    }
}