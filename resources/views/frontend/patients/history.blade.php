@extends('layouts.app')
@section('title')
    Patient Summaries
@endsection

@section('content')
<div class="content-wrapper">
    <div class="card mt-5" style="padding: 10px">
        <div class="card-header bg-primary header-main" style="height: 6em">
            <div class="row mt-3">
                <div class="col-md-4">
                    <h5 class="text-center">Visit Summary</h5>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table daily_logs_table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Appointment Slot</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->patientAppointments as $appointment)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $appointment->date->toFormattedDateString() }}</td>
                                <td>{{ $appointment->start_time }}</td>
                                <td>
                                    <a href="{{ route('patient.summary.show', $appointment->id) }}" class="btn btn-success">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>
@endsection