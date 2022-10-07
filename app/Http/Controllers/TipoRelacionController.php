<?php

namespace App\Http\Controllers;

use App\Models\Tiporelacion;
use Illuminate\Http\Request;

class TipoRelacionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tiporelacion::all();
    }

   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tiporelacion  $tiporelacion
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Tiporelacion::findOrFail($id);
    }

   
    
}
