@extends('layouts.app')
@section('title')
    Create Time Slots
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('time_slots.store') }}">
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        {{ __('Create Time Slot') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Start Time:</label>
                                    <div class="input-group date" id="start_time" data-target-input="nearest">
                                      <input type="text" name="start_time" class="form-control datetimepicker-input" data-target="#start_time"/>
                                      <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>End Time:</label>
                                    <div class="input-group date" id="end_time" data-target-input="nearest">
                                      <input type="text" name="end_time" class="form-control datetimepicker-input" data-target="#end_time"/>
                                      <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Slot Length:</label>
                                    <select name="slot_length" class="form-control">
                                        <option value="30 minutes">30 Minutes</option>
                                        <option value="60 minutes">60 Minutes</option>
                                        <option value="90 minutes">90 Minutes</option>
                                        <option value="120 minutes">120 Minutes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </div>
            </form>
            @if (isset($slots))
                <div class="card">
                    <div class="card-header">
                        Doctor Slots
                    </div>
                    <div class="card-body">
                        <div class="row mt-5">
                            @foreach ($slots as $slot)
                                <div class="col-md-3">
                                    <div class="color-palette-set slots-color-palette-set">
                                        <div class="bg-primary disabled color-palette slot-color-palette">
                                            <a href="javascript::void(0)" class="book-slot">{{ $slot }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
