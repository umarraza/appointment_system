<table class="table table-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>Date</th>
            <th>Patient Name</th>
            <th>Start Time</th>
            <th>Status</th>
            @if (Route::getCurrentRoute()->getName() == 'doctor.appointments')
                <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $appointment->date->format('m-d-Y') }}</td>
                <td><a href="">{{ $appointment->patient->full_name }}</a></td>
                <td>{{ $appointment->start_time }}</td>
                <td>{!! $appointment->status_label !!}</td>
                @if (Route::getCurrentRoute()->getName() == 'doctor.appointments')
                    <td> 
                        <a href="{{ route('doctor.slot.booking.confirm') }}" data-booking-id="{{ $appointment->id }}" data-booking-status="1" class="btn btn-success btn-xs confirm-booking">Accept</a>    
                        <a href="{{ route('doctor.slot.booking.reject', $appointment->id) }}" data-booking-status="2" class="btn btn-danger btn-xs">Reject</a>    
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

 