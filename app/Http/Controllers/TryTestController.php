<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TryTestController extends Controller
{
    public function index()
    {
        return view('template.index');
    }
}
