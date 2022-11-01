<?php

namespace App\Http\Controllers;

use App\Models\Emocion;
use Illuminate\Http\Request;

class EmocionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Devuelve la lista de emociones
     */
    
    public function index()
    {
        return Emocion::all()->sortBy("id");
    }

    
}
