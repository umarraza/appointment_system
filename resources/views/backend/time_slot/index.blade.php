@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8" style="margin-top: 6%">
            <div class="card">
                <div class="card-header">
                    Booking Slots
                    <a href="{{ route('time_slots.create') }}" class="btn btn-primary btn-xs float-right">
                        Create Time Slots
                    </a>
                </div>
                <div class="card-body" id="slots-section">
                    <div class="row mt-5">
                        @foreach (auth()->user()->slots as $slot)
                            <div class="color-palette-set slots-color-palette-set ml-5">
                                <div class="bg-warning disabled color-palette slot-color-palette" style="padding: 5px 0 5px 21px;width: 100px;border-radius: 7px; margin-top:10px">
                                    <a href="javascript::void(0)">{{ $slot->start_time }}</a>
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
