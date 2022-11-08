<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Sesion;
use App\Models\Recuerdo;
use Illuminate\Http\Request;

class MultimediasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Index de la Multimedia";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra todos los multimedias de la base de datos
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function show(Multimedia $multimedia)
    {
        return Multimedia::all()->sortBy("id");
    }

    //Devuelve los archivos multimedia de un recuerdo concreto
    public function showByRecuerdo($idRecuerdo)
    {
        return Recuerdo::find($idRecuerdo)->multimedias;
    }

    //Devuelve los archivos multimedia de un recuerdo concreto
    public function showBySesion($idSesion)
    {
        return Sesion::find($idSesion)->multimedias;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function edit(Multimedia $multimedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Multimedia $multimedia)
    {
        //
    }
}
