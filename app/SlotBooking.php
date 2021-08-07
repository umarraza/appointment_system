<?php

namespace App;

use App\User;
use App\PatientSummary;
use Illuminate\Database\Eloquent\Model;

class SlotBooking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slot_bookings';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'updated_at', 'deleted_at'];


    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function summary()
    {
        return $this->hasOne(PatientSummary::class, 'booking_id');
    }

    // public function slot()
    // {
    //     return $this->belongsTo(TimeSlot::class, '');
    // }

    /**
     * @return mixed
     */
    public function getStatusLabelAttribute() {

        if ($this->status == 'approved')
            return '<span class="badge bg-success">Accepted</span>';
        elseif ($this->status == 'pending')
            return '<span class="badge bg-danger">Pending</span>';
        elseif ($this->status == 'rejected')
            return '<span class="badge bg-danger">Rejected</span>';
        else
            return '<span class="badge bg-warning">Pending</span>';
    }
    
    /**
     * Chek if slot already booked or not
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return bool
     */
    public function ifSlotBookedBefore(Request $request) 
    {
        $booking = SlotBooking::where('teacher_id', $request->id)
            ->whereDate('created_at', Carbon::today())
            ->where('student_id', auth()->user()->id)
            ->where('start_time', $request->start_time)
            ->first();
    
        return $booking ? true : false;
    }
}
