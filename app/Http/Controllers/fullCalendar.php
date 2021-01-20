<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fullCalendar extends Controller
{
    public function index() {
        return view('form_calendar');
    }
}
