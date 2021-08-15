@extends('layouts.app')
@section('title')
    Time Slots
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8" style="margin-top: 6%">
            <div class="card">
                <div class="card-header bg-primary header-main">
                    <h3 class="card-title">Booking Slots &nbsp;&nbsp;<span class="badge badge-light">{{ auth()->user()->slots->first()->date->toFormattedDateString() }}</span></h3>
                    <a href="{{ route('time_slots.create') }}" class="btn btn-default btn-xs float-right" style="color: #000 !important">
                        Create Time Slots
                    </a>
                </div>
                <div class="card-body slots_section_background" id="slots-section">
                    <div class="row mt-5">
                        @if (auth()->user()->slots->count() > 0)
                            @foreach (auth()->user()->slots as $slot)
                                <div class="bg-info disabled color-palette slot-color-palette slots_boxes {{ $slot->status == 'pending' ? 'pending_status' : '' }} {{ $slot->status == 'booked' ? 'booked_status' : '' }}">
                                    <a href="{{ route('doctor.appointments.new') }}">{{ date('h:i a', strtotime($slot->start_time)) }}</a>
                                </div>
                            @endforeach
                        @else
                            <h4 style="text-align:center; color: rgb(192, 189, 189) !important">No Time Slots Created</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
