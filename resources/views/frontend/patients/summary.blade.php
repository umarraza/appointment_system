@extends('layouts.app')
@section('title')
    Patient Summary
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card" style="padding: 10px">
                <div class="card-header bg-primary header-main">
                    <h3 class="card-title">Visit Summary</h3>
                    @if (auth()->user()->isDoctor())
                        <a href="{{ route('patient.summary.index', ['id' => $patient->id]) }}" class="btn btn-default btn-xs float-right" style="color: #000 !important">
                            Back To List
                        </a>
                    @elseif (auth()->user()->isPatient())
                        <a href="{{ route('patient.visit_history') }}" class="btn btn-default btn-xs float-right" style="color: #000 !important">
                            Back To List
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow: hidden">
                        <h3><b>Consulting Physician</b></h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>Dr. {{ auth()->user()->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Tel:</th>
                                    <td>{{ auth()->user()->profile->tel }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ auth()->user()->profile->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h3><b>Patient Details</b></h3>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $patient->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone:</th>
                                            <td>{{ $patient->profile->tel }}</td>
                                        </tr>
                                        <tr>
                                            <th>Age:</th>
                                            <td>{{ $patient->profile->age }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address:</th>
                                            <td>{{ $patient->profile->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Appointment Date</th>
                                            <td><span class="badge badge-primary">{{ $booking->date->toFormattedDateString() }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>MRN:</th>
                                            <td>ZZZZIW17</td>
                                        </tr>
                                        <tr>
                                            <th>Date Of Birth:</th>
                                            <td>2/25/2007</td>
                                        </tr>
                                        <tr>
                                            <th>Language</th>
                                            <td>SPANISH</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h3><b>Current Medications</b></h3>
                        <p>{{ isset($booking->summary) ? $booking->summary->medicine_details : '' }}</p>
                        <h3><b>Allergies</b></h3>
                        <p>{{ isset($booking->summary) ? $booking->summary->allergies : '' }}</p>
                        <h3><b>Reason for visit stated by patient</b></h3>
                        <p>{{ isset($booking->summary) ? $booking->summary->reason_of_visit : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection