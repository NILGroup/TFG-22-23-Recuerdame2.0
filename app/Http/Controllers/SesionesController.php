<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use App\Models\Recuerdo;
use App\Models\Multimedia;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Estado;
use App\Models\Etiqueta;
use App\Models\Emocion;
use App\Models\Categoria;
use App\Models\PersonaRelacionada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SesionesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role', 'isTerapeuta']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Index de las sesiones";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $recuerdos = Recuerdo::where('paciente_id', Session::get('paciente')['id'])->get()->keyBy("id");
        $estados = Estado::all();
        $etiquetas = Etiqueta::all();
        $etapas = Etapa::all();
        $emociones = Emocion::all();
        $categorias = Categoria::all();
        $prelacionadas = Personarelacionada::where('paciente_id', Session::get('paciente')['id'])->get()->keyBy("id");

        return view("sesiones.create", compact('etapas', 'user', 'recuerdos', 'estados', 'etiquetas','emociones', 'categorias', 'prelacionadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sesion = Sesion::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'etapa_id' => $request->etapa_id,
             'objetivo' => $request->objetivo,
             'descripcion' => $request->descripcion,
             'barreras' => $request->barreras,
             'facilitadores' => $request->facilitadores,
             'fecha_finalizada' => $request->fecha_finalizada,
             'paciente_id' => $request->paciente_id,
             'user_id' => $request->user_id,
             'respuesta' => $request->respuesta]
        );
        return redirect("pacientes/{$sesion->paciente->id}/sesiones");
    }

    public function storeRecuerdo($idPaciente, $idSesion, $recuerdo)
    {
        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $recuerdo->id],
            ['fecha' => $recuerdo->fecha,
             'nombre' => $recuerdo->etapa_id,
             'descripcion' => $recuerdo->objetivo,
             'localizacion' => $recuerdo->descripcion,
             'etapa_id' => $recuerdo->barreras,
             'categoria_id' => $recuerdo->facilitadores,
             'emocion_id' => $recuerdo->fecha_finalizada,
             'estado_id' => $recuerdo->paciente_id,
             'etiqueta_id' => $recuerdo->user_id,
             'puntuacion' => $recuerdo->respuesta,
             'paciente_id' => $idPaciente]
        );

        
        return $recuerdo->id;
    }

    public function storeRecuerdos($idSesion, $listaRecuerdos)
    {
        return "TO DO";
    }

    public function storeMultimedia($idSesion, $listaFicheros)
    {
        return "TO DO";
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //https://youtu.be/g-Y9uiAjOE4
        $sesion = Sesion::findOrFail($id);
        $etapas = Etapa::all();
        //throw new \Exception($sesion->multimedias);
        return view('sesiones.show', compact('sesion', 'etapas'));
    }

    public function showEditable($id)
    {
        $sesion = Sesion::findOrFail($id);
        $etapas = Etapa::all();
        //throw new \Exception($sesion->multimedias);
        return view('sesiones.edit', compact('sesion', 'etapas'));
    }

    public function showByPaciente($idPaciente)
    {
        //https://www.youtube.com/watch?v=y3p10h_00A8&ab_channel=CodeStepByStep

        $paciente = Paciente::findOrFail($idPaciente);
        session()->put('paciente', $paciente->toArray());
        $sesiones = $paciente->sesiones;
        return view('sesiones.showByPaciente', compact('paciente', 'sesiones'));
    }

    public function showMultimedia($idSesion)
    {
        //https://www.youtube.com/watch?v=y3p10h_00A8&ab_channel=CodeStepByStep

        return Sesion::find($idSesion)->multimedias;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesion $sesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sesion = Sesion::find($id);
        $idP = $sesion->paciente_id;
        Sesion::destroy($id);
        return redirect("/pacientes/$idP/sesiones");
    }

    public function destroyRecuerdo($idSesion, $idRecuerdo)
    {
        //
       // Sesion::destroy($id);
    }

    public function destroyMultimedia($idSesion, $idMultimedia)
    {
        //
       return Sesion::find($idSesion)->multimedias::destroy($idMultimedia);
    }

    //Agregar un nuevo recuerdo cuando editas una sesión
    //Guarda los cambios y te redirige a la vista de crear recuerdo
    public function updateAndRecuerdoNuevo(Request $request){
        $sesion = Sesion::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'etapa_id' => $request->etapa_id,
             'objetivo' => $request->objetivo,
             'descripcion' => $request->descripcion,
             'barreras' => $request->barreras,
             'facilitadores' => $request->facilitadores,
             'fecha_finalizada' => $request->fecha_finalizada,
             'paciente_id' => $request->paciente_id,
             'user_id' => $request->user_id,
             'respuesta' => $request->respuesta,
             'observaciones' => $request->observaciones
            ]);
        return redirect("/recuerdos/crearAndVolverEditar");
    }
    
    public function updateAndSeleccionarRecuerdos(Request $request){
        
        $sesion = Sesion::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'etapa_id' => $request->etapa_id,
             'objetivo' => $request->objetivo,
             'descripcion' => $request->descripcion,
             'barreras' => $request->barreras,
             'facilitadores' => $request->facilitadores,
             'fecha_finalizada' => $request->fecha_finalizada,
             'paciente_id' => $request->paciente_id,
             'user_id' => $request->user_id,
             'respuesta' => $request->respuesta,
             'observaciones' => $request->observaciones
            ]);
        return redirect("/recuerdos/agregarAndVolverEditar");
    }

}
