<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index()
    {
        return view('manual');
    }
}
