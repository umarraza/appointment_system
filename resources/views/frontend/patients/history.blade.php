@extends('layouts.app')
@section('title')
    Patient Summaries
@endsection

@section('content')
<div class="content-wrapper">
    <div class="card mt-5" style="padding: 10px">
        <div class="card-header bg-primary header-main">
            <h3 class="card-title">{{ auth()->user()->full_name }} Vist Summary</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
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
                                    <a href="{{ route('patient.summary.show', $appointment->id) }}" class="btn btn-success btn-xs">Show</a>
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