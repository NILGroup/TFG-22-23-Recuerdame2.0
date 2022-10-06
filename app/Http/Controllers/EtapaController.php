<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    /**
     * Devuelve la lista de etapas
     */

    public function showAll()
    {     
        return Etapa::all();
    }
  

    /**
     * Devuelvee la etapa especificada
     */

    public function show(int $id)
    {
        return Etapa::findOrFail($id);    
    }

    
}
