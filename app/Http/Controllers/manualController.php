<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class manualController extends Controller
{
    public function index()
    {
        return view('manual');
    }
}
