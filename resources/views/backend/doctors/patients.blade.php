@extends('layouts.app')
@section('title') Patients | Appointment System @endsection

@section('content')
<div class="content-wrapper">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card" style="padding: 10px">
                <div class="card-header bg-primary header-main">
                    <h3 class="card-title">Patients</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ route('user.profile', $patient->id) }}">{{ $patient->full_name }}</a></td>
                                    <td>{{ $patient->profile->age }}</td>
                                    <td>{{ $patient->profile->sex }}</td>
                                    <td>{{ $patient->profile->date_of_birth }}</td>
                                    <td>
                                        <a href="{{ route('patient.summary.index', ['id' => $patient->id]) }}" class="btn btn-primary btn-xs">Summary</a>    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
