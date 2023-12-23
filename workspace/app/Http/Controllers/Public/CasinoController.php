<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasinoController extends Controller
{

    public function list() {
        return view('casino.list');
    }
}
