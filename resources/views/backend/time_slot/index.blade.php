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
                    <h3 class="card-title">Booking Slots</h3>
                    <a href="{{ route('time_slots.create') }}" class="btn btn-default btn-xs float-right" style="color: #000 !important">
                        Create Time Slots
                    </a>
                </div>
                <div class="card-body" id="slots-section">
                    <div class="row mt-5">
                        @if (auth()->user()->slots->count() > 0)
                            @foreach (auth()->user()->slots as $slot)
                                <div class="color-palette-set slots-color-palette-set ml-5">
                                    <div class="bg-info disabled color-palette slot-color-palette" style="padding: 5px 0 5px 21px;width: 100px;border-radius: 7px; margin-top:10px; box-shadow: 0 7px 6px -6px black;">
                                        <a href="javascript::void(0)">{{ date('h:i a', strtotime($slot->start_time)) }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <p>No Time Slots Created!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
