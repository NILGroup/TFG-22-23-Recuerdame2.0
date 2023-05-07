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
        return Tiporelacion::all()->sortBy("id");
    }


    /**
     * Display the specified resource. 
     * t
     * @param  \App\Models\Tiporelacion  $tiporelacion
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Tiporelacion::findOrFail($id);
    }

    public function storeNoView(Request $request){

        Tiporelacion::create(["nombre" => $request->nombre]);

    }


    
}
