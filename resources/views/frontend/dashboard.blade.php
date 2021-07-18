@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div id="patientDashboard">
    <section class="content">
      <div class="col-4 mt-5" style="margin-left:auto;margin-right:auto;">
          <form action="{{ route('doctors.search') }}" method="post" id="search-doctor_form">
              @csrf
              <div class="text-center">
                  <h3>Search Doctor</h3>
              </div>
              <input type="text" name="specialisation" class="form-control" class="search-doctor" id="inputName">
              <div class="offset-sm-2 col-sm-10 mt-3">
                  <button type="submit" class="btn btn-danger" style="float:right">Search</button>
              </div>
          </form>
      </div>
    </section>
    <section class="content" style="margin-top:5em !important">
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                    <div id="doctors-container"></div>
                </div>
            <div class="col-4"></div>
        </div>
    </section>
  </div>  
</div>
@endsection