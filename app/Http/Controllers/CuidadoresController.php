<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuidadoresController extends Controller
{
    
    public function create(){
        return view('cuidadores.create');
    }

}
