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
                    <h3 class="card-title">Time Slots</h3>
                </div>
                <div class="card-body" id="slots-section">
                    <div class="row mt-5">
                        @foreach ($slots as $slot)
                            <div class="color-palette-set slots-color-palette-set ml-5">
                                <div class="bg-info disabled color-palette slot-color-palette" style="padding: 5px 0 5px 21px;width: 100px;border-radius: 7px; margin-top:10px; box-shadow: 0 7px 6px -6px black;">
                                    <a href="{{ route('doctor.slot.book') }}" data-slot-id="{{ $slot->id }}" data-doctor-id="{{ $slot->doctor_id }}" class="book-slot">{{ $slot->start_time }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
