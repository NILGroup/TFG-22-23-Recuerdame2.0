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
use App\Models\InformeSesion;

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
        $informes = InformeSesion::where('paciente_id',$idPaciente)->get();
        return view("informesSesion.showByPaciente", compact('informes'));
    }

    public function generarInforme($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $informe = new InformeSesion();
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
        $user = $sesion->user;
        
        return view('informesSesion.create', compact('paciente', 'informe', 'sesion', 'user', 'show', 'recuerdos','complejidades','participaciones', 'estados', 'etiquetas', 'etapas', 'emociones', 'categorias', 'tipos', 'recuerdo', 'idPaciente', 'persona', 'personas', 'mostrarFoto'));
    }

    public function edit($idPaciente, $idI){
        $informe = InformeSesion::find($idI);
        $sesion = $informe->sesion;
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
        $user = $sesion->user;
        return view('informesSesion.create', compact('paciente', 'informe', 'sesion', 'user', 'show', 'recuerdos','complejidades','participaciones', 'estados', 'etiquetas', 'etapas', 'emociones', 'categorias', 'tipos', 'recuerdo', 'idPaciente', 'persona', 'personas', 'mostrarFoto'));
    }

    public function store(Request $request){
        
        $informe = InformeSesion::updateOrCreate(
            ['id' => $request->id],
            ['fecha_finalizada' => $request->fecha_finalizada,
            'duracion' => $request->duracion,
            'respuesta' => $request->respuesta,
            'observaciones' => $request->observaciones,
            'barreras' => $request->barreras,
            'facilitadores' => $request->facilitadores,
            'propuestas' => $request->propuestas,
            'paciente_id' => $request->paciente_id,
            'user_id' => $request->user_id,
            'sesion_id' => $request->sesion_id,
            'participacion_id' => $request->participacion_id,
            'complejidad_id' => $request->complejidad_id,
        ]);
        
        session()->put('created', "true");
        return redirect("/usuarios/$informe->paciente_id/informesSesion");
    }

    public function update(Request $request){
        
        $informe = InformeSesion::updateOrCreate(
            ['id' => $request->id],
            ['fecha_finalizada' => $request->fecha_finalizada,
            'duracion' => $request->duracion,
            'respuesta' => $request->respuesta,
            'observaciones' => $request->observaciones,
            'barreras' => $request->barreras,
            'facilitadores' => $request->facilitadores,
            'propuestas' => $request->propuestas,
            'paciente_id' => $request->paciente_id,
            'user_id' => $request->user_id,
            'sesion_id' => $request->sesion_id,
            'participacion_id' => $request->participacion_id,
            'complejidad_id' => $request->complejidad_id,
        ]);
        
        session()->put('created', "true");
        return redirect("/usuarios/$informe->paciente_id/informesSesion/$informe->id");
    }

    public function show(int $idP,int $idI)
    {
        $informe = InformeSesion::findOrFail($idI);
        $sesion = $informe->sesion;
        $paciente = $sesion->paciente;
        $user = $informe->user;
        $participaciones = Participacion::all()->sortBy("id");
        $complejidades = Complejidad::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $show = true;
        return view("informesSesion.show", compact("sesion","informe","user","etapas",  "participaciones","complejidades", "paciente", "show"));
    }

    public function destroy($id){
        InformeSesion::destroy($id);
        InformeSesion::where('id', $id)->withTrashed()->restore();
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
