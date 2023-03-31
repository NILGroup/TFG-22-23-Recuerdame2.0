<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Etiqueta;
use App\Models\Emocion;
use App\Models\Participacion;
use App\Models\Complejidad;
use App\Models\Tiporelacion;
use App\Models\Recuerdo;
use App\Models\Personarelacionada;

class InformesSesionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
    }
    
    public function showByPaciente($idPaciente){
        $sesiones = Sesion::where('paciente_id',$idPaciente)->where("finalizada", true)->get();
        return view("informesSesion.showByPaciente", compact('sesiones'));
    }

    public function generarInforme($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        $recuerdos = $sesion->recuerdos;
        $estados = Estado::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $participaciones = Participacion::all()->sortBy("id");
        $complejidades = Complejidad::all()->sortBy("id");
        $emociones = Emocion::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $tipos = Tiporelacion::all()->sortBy("id");
        $recuerdo = new Recuerdo();
        $persona = new Personarelacionada();
        $personas = Personarelacionada::where('paciente_id', $paciente->id)->get()->keyBy("id");
        $show = false;
        $mostrarFoto = false;
        return view('informesSesion.create', compact('paciente', 'sesion', 'show', 'recuerdos','complejidades','participaciones', 'estados', 'etiquetas', 'etapas', 'emociones', 'categorias', 'tipos', 'recuerdo', 'idPaciente', 'persona', 'personas', 'mostrarFoto'));
    }

    public function store(Request $request){
        $sesion = Sesion::find($request->id);
        $sesion->fecha = $request->fecha;
        $sesion->fecha_finalizada = $request->fecha_finalizada;
        $sesion->respuesta = $request->respuesta;
        $sesion->observaciones = $request->observaciones;
        $sesion->barreras = $request->barreras;
        $sesion->facilitadores = $request->facilitadores;
        $sesion->duracion = $request->duracion;
        $sesion->participacion_id = $request->participacion_id;
        $sesion->complejidad_id = $request->complejidad_id;
        $sesion->finalizada = true;
        $sesion->save();
        
        session()->put('created', "true");
        return redirect("/pacientes/$sesion->paciente_id/sesiones/$sesion->id/ver");
    }

    public function show(int $idP, int $idS)
    {
        $sesion = Sesion::findOrFail($idS);
        $paciente = $sesion->paciente;
        $participaciones = Participacion::all()->sortBy("id");
        $complejidades = Complejidad::all()->sortBy("id");
        $show = true;
        return view("informesSesion.show", compact("sesion","participaciones","complejidades", "paciente", "show"));
    }

    public function destroy($id){
        $sesion = Sesion::find($id);
        /*
        $sesion->respuesta = null;
        $sesion->fecha_finalizada = null;
        $sesion->observaciones = null;
        */
        $sesion->finalizada = false;
        $sesion->save();
        //return redirect("/pacientes/$sesion->paciente_id/informesSesion");
    }
    public function restore($idP, $id){
        $sesion = Sesion::find($id);
        $sesion->finalizada = true;
        $sesion->save();
    }

    public function verInformeSesion($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        return view('informesSesion.show', compact('paciente', 'sesion'));
    }
}
