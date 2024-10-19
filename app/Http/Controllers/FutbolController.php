<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FutbolController extends Controller
{
    public function futbol()
    {
        return view('futbol');
    }
}
