<?php

namespace App\Http\Controllers;

use App\Models\Recuerdo;
use App\Models\Sesion;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Etiqueta;
use App\Models\Paciente;
use Illuminate\Http\Request;

class RecuerdosController extends Controller
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
        //
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
        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'nombre' => $request->nombre,
             'descripcion' => $request->descripcion,
             'etapa_id' => $request->etapa_id,
             'categoria_id' => $request->categoria_id,
             'emocion_id' => $request->emocion_id,
             'estado_id' => $request->estado_id,
             'etiqueta_id' => $request->etiqueta_id,
             'puntuacion' => $request->puntuacion,
             'paciente_id' => $request->paciente_id]
        );
        $recuerdo->save();
        return $recuerdo->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function show($idRecuerdo)
    {
        return Recuerdo::find($idRecuerdo);
    }

    public function showByPaciente($idPaciente)
    {
        $paciente =Paciente::find($idPaciente);
        $recuerdos = $paciente->recuerdos;
        foreach ($recuerdos as $r) {
                $r->etapa_id = Etapa::find($r->etapa_id)->nombre;
                $r->categoria_id = Categoria::find($r->categoria_id)->nombre;
                $r->estado_id = Estado::find($r->estado_id)->nombre;
                $r->etiqueta_id = Etiqueta::find($r->etiqueta_id)->nombre;
            }
        //Devolvemos los recuerdos
        return view("recuerdos.showByPaciente", compact("recuerdos"));
    }

    public function showBySesion($idSesion)
    {
        return Sesion::find($idSesion)->recuerdos;
    }

    public function showMultimedia($idRecuerdo)
    {
        return Sesion::find($idRecuerdo)->multimedias;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recuerdo $recuerdo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recuerdo $recuerdo)
    {
        //
    }

    /**
     * Elimina el recuerdo en cuestión
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRecuerdo)
    {
        Recuerdo::destroy($idRecuerdo);
    }

    //Elimina a la persona relacionada del recuerdo en cuestión (su relación)
    public function destroyPersonaRelacionada($idRecuerdo, $idPersona)
    {
        //¿unsetRelation?
    //    Recuerdo::find($idRecuerdo)->personas_relacionadas   destroy($idRecuerdo);
    }

    //Devuelve la fecha del recuerdo más antiguo del paciente
    public function oldestMemoryDate($idPaciente)
    {
        $memory = Paciente::find($idPaciente)->recuerdos
                                                ->orderBy('fecha')
                                                ->take(1)
                                                ->get();
        return $memory->fecha;
    }
}
