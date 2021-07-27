<?php

namespace App;

use App\Profile;
use App\TimeSlot;
use App\SlotBooking;
use App\PatientSummary;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return bool
     */
    public function isDoctor()
    {
        return $this->role == 'Doctor' ? true : false;
    }

    /**
     * @return bool
     */
    public function isPatient()
    {
        return $this->role == 'Patient' ? true : false;
    }

    /**
     * @return mixed
     */
    public function slots()
    {
        return $this->hasMany(TimeSlot::class, 'doctor_id');
    }

    /**
     * @return mixed
     */
    public function doctorAppointments()
    {
        return $this->hasMany(SlotBooking::class, 'doctor_id');
    }

    /**
     * @return mixed
     */
    public function patientAppointments()
    {
        return $this->hasMany(SlotBooking::class, 'patient_id');
    }

    /**
     * @return mixed
     */
    public function summaries()
    {
        return $this->hasMant(PatientSummary::class, 'patient_id');
    }

    /**
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}