<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Este controlador no tiene uso real en nuestra aplicación */
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
}
