<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransmartController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
}
