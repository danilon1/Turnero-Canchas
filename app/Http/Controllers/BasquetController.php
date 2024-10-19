<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasquetController extends Controller
{
    public function basquet()
    {
        return view('basquet');
    }
}
