<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function history()
    {
        return view('frontend.patients.history');
    }
}
