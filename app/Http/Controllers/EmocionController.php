<?php

namespace App\Http\Controllers;

use App\Models\Emocion;
use Illuminate\Http\Request;

class EmocionController extends Controller
{
    /**
     * Devuelve la lista de emociones
     */
    
    public function index()
    {
        return Emocion::all();
    }

    
}
