<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatBerat;


class HomeController extends Controller
{
    public function index()
    {
        $alat =AlatBerat::all();
        return view('home', compact('alat'));
    }
}
