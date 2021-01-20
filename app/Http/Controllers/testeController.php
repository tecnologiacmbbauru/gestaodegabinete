<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testeController extends Controller
{

    public function index(){
        return view('teste');
    }
}