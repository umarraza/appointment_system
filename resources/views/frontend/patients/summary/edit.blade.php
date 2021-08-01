@extends('layouts.app')
@section('title')
    Edit Summary
@endsection

@section('content')
<div class="content-wrapper">
    <div class="card mt-5" style="padding: 10px">
        <div class="card-header bg-primary header-main" style="height: 6em">
            <div class="row mt-3">
                {{-- <div class="col-md-4">
                    <a href="{{ route('patient.summary.index', ['id' => $booking->id]) }}" class="btn btn-sm btn-light"><i class="fa-solid fa-pencil"></i> Back To List</a>
                </div> --}}
                <div class="col-md-4">
                    <h5 class="text-center">Edit Summary</h5>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('patient.summary.update', $booking->id) }}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-form-label text-md-right">{{ __('Medications') }}</label>
                    <textarea class="form-control" name="medication" value="{{ old('medication') }}" required autocomplete="medication" autofocus>{{ $booking->summary()->exists() ? $booking->summary->medicine_details : '' }}</textarea>
                    @error('medication')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="name" class="col-form-label text-md-right">{{ __('Allergies') }}</label>
                    <textarea class="form-control" name="allergies" value="{{ old('allergies') }}" required autocomplete="allergies" autofocus>{{ $booking->summary()->exists() ? $booking->summary->allergies : '' }}</textarea>
                    @error('allergies')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="name" class="col-form-label text-md-right">{{ __('Reason of visit') }}</label>
                    <textarea class="form-control" name="reason_of_visit" value="{{ old('reason_of_visit') }}" required autocomplete="reason_of_visit" autofocus>{{ $booking->summary()->exists() ? $booking->summary->reason_of_visit : '' }}</textarea>
                    @error('reason_of_visit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" name="revisit" id="revisit" @if($booking->summary()->exists() && $booking->summary->revisit) checked @endif>
                      <label class="custom-control-label" for="revisit">Revisit?</label>
                    </div>
                </div>
                <div class="form-group row mb-0 float-right">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection