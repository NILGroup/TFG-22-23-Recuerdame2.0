<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class EtapaController extends Controller
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
     * Devuelve la lista de etapas
     */

    public function showAll()
    {     
        return Etapa::all()->sortBy("id");
    }
  

    /**
     * Devuelvee la etapa especificada
     */

    public function show(int $id)
    {
        return Etapa::findOrFail($id);    
    }

    
}
