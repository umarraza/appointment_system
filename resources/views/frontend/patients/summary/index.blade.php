@extends('layouts.app')
@section('title')
    Patient Summaries
@endsection

@section('content')
<div class="content-wrapper">
    <div class="card mt-5" style="padding: 10px">
        <div class="card-header bg-primary header-main">
            <h3 class="card-title">{{ $patient->full_name }} Vist Summary</h3>
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
                        @foreach($patient->patientAppointments as $appointment)
                            @if ($appointment->status == 'approved')
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $appointment->date->toFormattedDateString() }}</td>
                                    <td>{{ date('h:i a', strtotime($appointment->start_time)) }}</td>
                                    <td>
                                        <a href="{{ route('patient.summary.edit', $appointment->id) }}" class="btn btn-info btn-xs">Edit</a>
                                        <a href="{{ route('patient.summary.show', $appointment->id) }}" class="btn btn-success btn-xs">Show</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>
@endsection