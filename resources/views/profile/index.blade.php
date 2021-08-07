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
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ auth()->user()->avatarPath() }}"
                       alt="User profile picture" style="height: 100px !important;">
                </div>
                <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                @if ($user->isDoctor())    
                    <p class="text-muted text-center">{{ $user->profile->specialisation }}</p>
                @endif
                <div class="text-center mb-2">
                  <a href="{{ route('profile.edit', $user->id) }}" type="buttn" class="btn btn-primary">Edit Profile</a>
                </div>
                <ul class="list-group list-group-unbordered mb-3" style="width: 50em; margin-left: auto; margin-right: auto;">
                  <li class="list-group-item">
                    <b>Age</b> <p class="float-right">{{ $user->profile->age }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Gender</b> <p class="float-right">{{ $user->profile->sex }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Tel</b> <p class="float-right">{{ $user->profile->tel }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Address</b> <p class="float-right">{{ $user->profile->address }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Date Of Birth</b> <p class="float-right">{{ $user->profile->date_of_birth ? $user->profile->date_of_birth->format('m-d-Y') : '' }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Language</b> <p class="float-right">{{ $user->profile->language }}</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection