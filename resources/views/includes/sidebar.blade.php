<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="index3.html" class="brand-link">
    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
    <span class="brand-text font-weight-light" style="font-size:15px">Online Appointment System</span>
</a>
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image text-center" style="padding-left: 4.4rem !important;">
            <img src="{{ auth()->user()->avatarPath() }}" class="img-circle elevation-2" alt="User Image" style="width: 100px; height: 100px;">
            <a href="#" class="d-block mt-1">{{ auth()->user()->full_name }}</a>
            <span class="badge badge-info">{{ auth()->user()->role }}</span>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ auth()->user()->isDoctor() ? route('doctor.dashboard')  : route('patient.dashboard') }}" class="nav-link {{ activeUrlClass('doctor.dashboard') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
            </li>
        </ul>
    </nav>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('user.profile', auth()->user()->id) }}" class="nav-link {{ activeUrlClass('user.profile') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account</p>
                </a>
            </li>
        </ul>
    </nav>
    @if (auth()->user()->isPatient())
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('patient.visit_history') }}" class="nav-link {{ activeUrlClass('patient.visit_history') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patient Visit History</p>
                </a>
            </li>
        </ul>
    </nav>
    @endif
    @if (auth()->user()->isDoctor())
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('doctor.appointments.new') }}" class="nav-link {{ activeUrlClass('doctor.appointments.new') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Appoinments</p>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('doctor.appointments.booked') }}" class="nav-link {{ activeUrlClass('doctor.appointments.booked') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Booked Appoinments</p>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('doctor.appointments.cenceled') }}" class="nav-link {{ activeUrlClass('doctor.appointments.cenceled') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Canceled Appoinments</p>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('doctor.patients') }}" class="nav-link {{ activeUrlClass('doctor.patients') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Patients</p>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('time_slots.index') }}" class="nav-link {{ activeUrlClass('time_slots.index') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Time Slots</p>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
</div>
</aside>