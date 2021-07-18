<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\TimeSlot;
use App\SlotBooking;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function appointments()
    {
        $appointments = auth()->user()->appointments->where('status', 'pending');

        return view('backend.doctors.appointments', compact('appointments'));
    }

    public function bookedappointments()
    {
        $appointments = auth()->user()->appointments->where('status', 'approved');

        return view('backend.doctors.appointments', compact('appointments'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {

            $doctors = User::join('doctors as doctor', 'doctor.user_id', '=', 'users.id')
                ->where('doctor.specialisation', 'LIKE', '%' . $request->get('specialisation') . '%')
                ->where('users.role','=', 'Doctor')
                ->get();
                
            return view('backend.doctors')
                ->withDoctors($doctors);
        }
    }

    public function show(User $user)
    {
        $slots = $user->slots()->where('status', 'available')->get();
        return view('backend.doctors.show', compact('slots'));
    }

    public function bookSlot(Request $request)
    {
        DB::beginTransaction();
        try {

            if ($request->ajax())
            {

                $booking = SlotBooking::where('pateint_id', auth()->user()->id)
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
                    'pateint_id'    => auth()->user()->id,
                    'doctor_id'     => $request->doctor_id,
                    'slot_id'       => $request->slot_id,
                    'start_time'    => $slot->start_time,
                    'end_time'      => $slot->end_time,
                    'status'        => 'pending',
                ]);

                $slot->update(['status' => 'pending']);

                DB::commit();

                return response()->json(['success' => 'Request has been sent for your booking!']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong, internal server error!']);
        }
    }

    public function acceptBooking(Request $request)
    {
        if ($request->ajax()) {
            
            $booking = SlotBooking::find($request->id)->update([
                'status' => 'approved'
            ]);

            $appointments = auth()->user()->appointments->where('status', 'pending');

            return response()->json(['success' => true]);
        }
    }

    public function rejectBooking()
    {

    }
}