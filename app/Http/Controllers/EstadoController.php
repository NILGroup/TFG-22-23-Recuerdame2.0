<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Devuelve la lista de estados
     */

    public function index()
    {
        return Estado::all();
    }

   
}
