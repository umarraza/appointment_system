@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8" style="margin-top: 6%">
            <div class="card">
                <div class="card-header bg-primary header-main">
                    <h3 class="card-title">Search Doctor</h3>
                </div>
                <div class="card-body">
                    <div id="patientDashboard">
                        <section class="content">
                          <div class="col-4 mt-5" style="margin-left:auto;margin-right:auto;">
                              <form action="{{ route('doctors.search') }}" method="post" id="search-doctor_form">
                                  @csrf
                                    <div class="form-group">
                                      <select name="specialisation" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach (_specialisations() as $specialisation)
                                            <option value="{{ $specialisation }}">{{ $specialisation }}</option>
                                        @endforeach
                                      </select>
                                    </div>
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
            </div>
        </div>
    </div>
</div>
@endsection