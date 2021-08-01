@extends('layouts.app')

@section('title') {{ Route::getCurrentRoute()->getName() == 'doctor.appointments' ? 'New Appointments' : 'Booked Appointments' }}  | Appointment System @endsection

@section('content')
<div class="content-wrapper">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card" style="padding: 10px">
                <div class="card-header bg-primary header-main">
                    <h3 class="card-title">{{ Route::getCurrentRoute()->getName() == 'doctor.appointments' ? 'New Appointments' : 'Booked Appointments' }}</h3>
                </div>
                <div class="card-body" id="bookings-requests_container">
                    @include('backend.doctors.table', ['appointments' => $appointments])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
