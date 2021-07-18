<?php

namespace App;

use App\TimeSlot;
use App\SlotBooking;
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

    public function isDoctor()
    {
        return $this->role == 'Doctor' ? true : false;
    }

    public function isPatient()
    {
        return $this->role == 'Patient' ? true : false;
    }

    public function slots()
    {
        return $this->hasMany(TimeSlot::class, 'doctor_id');
    }

    public function appointments()
    {
        return $this->hasMany(SlotBooking::class, 'doctor_id');
    }
}