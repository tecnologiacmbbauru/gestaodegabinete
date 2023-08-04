<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullCalendar extends Controller
{
    public function index() {
        return view('form_calendar');
    }
}
