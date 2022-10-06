<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showAll()
    {
        
        return Etapa::all();

    }
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etapa  $etapa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Etapa::findOrFail($id);
        
    }

    
}
