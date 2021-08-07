@extends('layouts.app')
@section('title') Profile | Appointment System @endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('profile.update', auth()->user()->id) }}" enctype='multipart/form-data'>
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="first_name">First Name</label>
                          <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}" placeholder="First Name">
                          @include('error', ['field' => 'first_name'])
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="last_name">Last Name</label>
                          <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}" placeholder="Last Name">
                          @include('error', ['field' => 'last_name'])
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="age">Age</label>
                          <input type="text" class="form-control @error('age') is-invalid @enderror" name="age" id="age" value="{{ auth()->user()->profile->age }}" placeholder="Age">
                          @include('error', ['field' => 'age'])
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ auth()->user()->profile->address }}" placeholder="Address">
                          @include('error', ['field' => 'address'])
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tel">Tel</label>
                          <input type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" id="tel" value="{{ auth()->user()->profile->tel }}" placeholder="Tel">
                          @include('error', ['field' => 'tel'])
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date Of Birth:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="date_of_birth" value="{{ auth()->user()->profile->date_of_birth ? auth()->user()->profile->date_of_birth->format('m-d-Y') : '' }}" class="form-control @error('date_of_birth') is-invalid @enderror datetimepicker-input" data-target="#reservationdate">
                                @include('error', ['field' => 'date_of_birth'])
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="language">Language</label>
                          <input type="text" class="form-control @error('language') is-invalid @enderror" name="language" id="language" value="{{ auth()->user()->profile->language }}" placeholder="Language">
                          @include('error', ['field' => 'language'])
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="avatar">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" name="avatar" id="avatar">
                              @include('error', ['field' => 'date_of_birth'])
                              <label class="custom-file-label" for="avatar">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer float-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection