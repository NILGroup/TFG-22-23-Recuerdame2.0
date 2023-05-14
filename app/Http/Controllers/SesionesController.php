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
use App\Models\Personarelacionada;
use App\Models\Tiporelacion;
use App\Models\InformeSesion;
use ErrorException;
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
        $this->middleware(['auth', 'role']);
        $this->middleware(['asignarPaciente'])->except(['index', 'create', 'destroy', 'restore']);
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
    public function create($id)
    {
        $show = false;
        $mostrarFoto = false;
        $persona = new Personarelacionada();
        $sesion = new Sesion();
        $recuerdo = new Recuerdo();
        $user = Auth::user();
        $paciente = Paciente::find($id);
        $personas = $paciente->personasrelacionadas;
        $recuerdos = Recuerdo::where('paciente_id', $paciente->id)->get();
        $estados = Estado::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $emociones = Emocion::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $tipos = Tiporelacion::all()->sortBy("id");
        $idPaciente = $paciente->id;
        $prelacionadas = Personarelacionada::where('paciente_id', $id)->get()->keyBy("id");

        $multimedias = [];

        $pacientes_terapeuta = $user->pacientes;

        foreach($pacientes_terapeuta as $p){
            foreach($p->sesiones as $s){
                foreach($s->multimedias as $m){

                    $existent = true;
                    foreach($multimedias as $mult){
                        if ($mult->id == $m->id){
                            $existent = false;
                        }
                    }

                    if ($existent) array_push($multimedias, $m);

                }
            }
        }


        return view("sesiones.create", compact('multimedias','persona','idPaciente','mostrarFoto','etapas', 'user', 'tipos', 'recuerdos', 'estados', 'etiquetas','emociones', 'categorias', 'prelacionadas', 'paciente', 'sesion', 'recuerdo', 'personas', 'show'));
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
            ['id' => $request->idSesion],
            ['fecha' => $request->fecha,
             'titulo' => $request->titulo,
             'etapa_id' => $request->etapa_id,
             'objetivo' => $request->objetivo,
             'descripcion' => $request->descripcion,
             'acciones' => $request->acciones,
             'fecha_finalizada' => $request->fecha_finalizada,
             'paciente_id' => $request->paciente_id,
             'user_id' => $request->user_id,
             'respuesta' => $request->respuesta]
        );

        $sesion->multimedias()->detach();
        if (isset($request->mult)) {
            $sesion->multimedias()->attach($request->mult);
        }

        MultimediasController::savePhotos($request, $sesion);

        $sesion->recuerdos()->detach();
        if(!is_null($request->recuerdos))
            $sesion->recuerdos()->attach($request->recuerdos);

       

        session()->put('created', "true");

      

        //return redirect("usuarios/{$sesion->paciente->id}/sesiones");
    }

/*
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
*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show($idP, $id)
    {
        //https://youtu.be/g-Y9uiAjOE4
        $sesion = Sesion::findOrFail($id);
        $etapas = Etapa::all()->sortBy("id");
        $paciente = $sesion->paciente;
        $user = $sesion->user;
        $recuerdos = $sesion->recuerdos;
        $show = true;
        //throw new \Exception($sesion->multimedias);
        return view('sesiones.show', compact('sesion', 'etapas', 'paciente', 'user', 'show', 'recuerdos'));
    }

    public function showEditable($idP, $id)
    {
        $show = false;
        $mostrarFoto = false;
        $sesion = Sesion::findOrFail($id);
        $user = Auth::user();
        $paciente = Paciente::find(Session::get('paciente')['id']);
        $personas = $paciente->personasrelacionadas;
        $recuerdo = new Recuerdo();
        $recuerdos = Recuerdo::where('paciente_id', $paciente->id)->get();
        $estados = Estado::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $emociones = Emocion::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $prelacionadas = Personarelacionada::where('paciente_id', Session::get('paciente')['id'])->get()->keyBy("id");
        $tipos = Tiporelacion::all()->sortBy("id");
        $idPaciente = $paciente->id;
        $persona = new Personarelacionada();

        $multimedias = [];

        $pacientes_terapeuta = $user->pacientes;

        foreach($pacientes_terapeuta as $p){
            foreach($p->sesiones as $s){
                foreach($s->multimedias as $m){

                    $existent = true;
                    foreach($multimedias as $mult){
                        if ($mult->id == $m->id){
                            $existent = false;
                        }
                    }

                    if ($existent) array_push($multimedias, $m);

                }
            }
        }

        //throw new \Exception($sesion->multimedias);
        return view('sesiones.edit', compact('multimedias','persona','idPaciente','mostrarFoto', 'sesion', 'etapas', 'user', 'recuerdos', 'estados', 'etiquetas','emociones', 'categorias', 'prelacionadas', 'paciente', 'show', 'personas', 'recuerdo', 'tipos'));
    }

    public function showByPaciente($idPaciente)
    {
        //https://www.youtube.com/watch?v=y3p10h_00A8&ab_channel=CodeStepByStep

        $paciente = Paciente::findOrFail($idPaciente);
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
        $sesion->informes()->delete();
        $idP = $sesion->paciente_id;
        Sesion::destroy($id);
        //return redirect("/usuarios/$idP/sesiones");
    }
    public function restore($idP, $id) 
    {
        Sesion::where('id', $id)->withTrashed()->restore();
        InformeSesion::where('sesion_id', $id)->withTrashed()->restore();
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
             'titulo' => $request->titulo,
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
        return redirect("/usuarios/{id}/recuerdos/crearAndVolverEditar");
    }
    
    public function updateAndSeleccionarRecuerdos(Request $request){
        
        $sesion = Sesion::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'titulo' => $request->titulo,
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
        return redirect("/usuarios/{id}/recuerdos/agregarAndVolverEditar");
    }

}
