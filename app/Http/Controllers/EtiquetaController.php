<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
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

    public function show($id)
    {
        return Etiqueta::findOrFail($id);
    }

   
}
