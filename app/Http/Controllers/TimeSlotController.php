<?php

namespace App\Http\Controllers;

use App\TimeSlot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function index()
    {
        return view('backend.time_slot.index');
    }

    public function create()
    {
        return view('backend.time_slot.create');
    }

    public function store(Request $request)
    {
        $period = new CarbonPeriod($request->start_time, $request->slot_length, $request->end_time);
        
        $slots = [];
        
        foreach($period as $item)
        {
            array_push($slots,date("G:i", strtotime($item)));
        }

        for ($i=0; $i < count($slots); $i++) {
            if (isset($slots[$i+1]))
            {
                TimeSlot::create([
                    'doctor_id' => auth()->user()->id,
                    'date' => now(),
                    'start_time' => $slots[$i],
                    'end_time' => $slots[$i+1],
                    'status' => 'available',
                ]);
            }
        }
        
        return redirect()->route('time_slots.index')->withSlots(auth()->user()->slots)->withMessage('success', 'Slots created successfully!');
    }
}
