<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isSupervisor');
        $this->middleware('isDefaultPassword');
    }

    public function indexSpv()
    {
        return view('spv.index');
    }
}
