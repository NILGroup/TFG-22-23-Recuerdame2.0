<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
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
     * Devuelve la lista de etiquetas
     */

    public function showAll()
    {
        return Etiqueta::all();
    }


    /**
     * Devuelve la etiqueta especificada
     */

    public function show(int $id)
    {
        return Etiqueta::findOrFail($id);
    }

   
}
