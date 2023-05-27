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
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
        $this->middleware(['asignarPaciente'])->except(['index', 'create', 'destroy', 'restore']);
    }

    /*
    * Redirige a la vista de creación de una sesión
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

    /*
    * Guarda una nueva sesión en la BBDD y redirige a la lista de sesiones
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
    * Redirige a la visualización de una sesión
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

    /*
    * Redirige a la edición de una sesión
    */
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

        return view('sesiones.edit', compact('multimedias','persona','idPaciente','mostrarFoto', 'sesion', 'etapas', 'user', 'recuerdos', 'estados', 'etiquetas','emociones', 'categorias', 'prelacionadas', 'paciente', 'show', 'personas', 'recuerdo', 'tipos'));
    }

    /*
    * Muestra la lista de sesiones de un paciente
    */
    public function showByPaciente($idPaciente)
    {
        $paciente = Paciente::findOrFail($idPaciente);
        $sesiones = $paciente->sesiones;
        return view('sesiones.showByPaciente', compact('paciente', 'sesiones'));
    }

    /*
    * ¿Función desechada? Muestra todos los archivos multimedia de una sesión
    */
    public function showMultimedia($idSesion)
    {
        return Sesion::find($idSesion)->multimedias;
    }

    /*
    * Elimina una sesión y todos sus informes
    */
    public function destroy($id)
    {
        $sesion = Sesion::find($id);
        $sesion->informes()->delete();
        $idP = $sesion->paciente_id;
        Sesion::destroy($id);
    }

    /*
    * Recupera una sesión eliminada y todos sus informes
    */
    public function restore($idP, $id) 
    {
        Sesion::where('id', $id)->withTrashed()->restore();
        InformeSesion::where('sesion_id', $id)->withTrashed()->restore();
    }

    /*
    * ¿Función desechada?
    */
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

    /*
    * Agregar un nuevo recuerdo cuando editas una sesión
    * Guarda los cambios y te redirige a la vista de crear recuerdo
    */
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
    
    /*
    *
    */
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
