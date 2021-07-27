@extends('layouts.app')
@section('title') Booked Appointments | Appointment System @endsection

@section('content')
<div class="content-wrapper">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Appointments</h3>
                </div>
                <div class="card-body" id="bookings-requests_container">
                    @include('backend.doctors.table', ['appointments' => $appointments])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
