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
                    <h3 class="card-title">Time Slots &nbsp;&nbsp;<span class="badge badge-light">{{ $slots->first()->date->toFormattedDateString() }}</span></h3>
                </div>
                <div class="card-body slots_section_background" id="slots-section">
                    <div class="row mt-5">
                        @forelse ($slots as $slot)
                            <div class="bg-info disabled color-palette slot-color-palette slots_boxes {{ $slot->status == 'pending' ? 'pending_status' : '' }} {{ $slot->status == 'booked' ? 'booked_status' : '' }}">

                                @if ($slot->status == 'booked' || $slot->status == 'pending')
                                    <a href="javascript::void(0)">{{ date('h:i a', strtotime($slot->start_time)) }}</a>
                                @else
                                    <a href="{{ route('doctor.slot.book') }}" data-slot-id="{{ $slot->id }}" data-doctor-id="{{ $slot->doctor_id }}" class="book-slot">{{ date('h:i a', strtotime($slot->start_time)) }}</a>
                                @endif
                            </div>
                        @empty
                            <h4 style="text-align:center; color: rgb(192, 189, 189) !important">No slots avilable</h4>
                        @endforelse 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
