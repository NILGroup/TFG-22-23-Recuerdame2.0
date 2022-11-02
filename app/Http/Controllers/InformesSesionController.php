<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;

class InformesSesionController extends Controller
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
    
    public function showByPaciente($idPaciente){
        $sesiones = Sesion::where('paciente_id',$idPaciente)->whereNotNull("fecha_finalizada")->get();
        return view("informesSesion.showByPaciente", compact('sesiones'));
    }

    public function generarInforme($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        $sesion->fecha_finalizada = \Carbon\Carbon::now()->format('Y-m-d');
        $show = false;
        return view('informesSesion.create', compact('paciente', 'sesion', 'show'));
    }

    public function store(Request $request){
        $sesion = Sesion::find($request->id);
        $sesion->fecha = $request->fecha;
        $sesion->fecha_finalizada = $request->fecha_finalizada;
        $sesion->respuesta = $request->respuesta;
        $sesion->observaciones = $request->observaciones;
        $sesion->barreras = $request->barreras;
        $sesion->facilitadores = $request->facilitadores;
        $sesion->save();
        return redirect("/pacientes/$sesion->paciente_id/sesiones/$sesion->id/ver");
    }

    public function show(int $idP, int $idS)
    {
        $sesion = Sesion::findOrFail($idS);
        $paciente = $sesion->paciente;
        $show = true;
        return view("informesSesion.show", compact("sesion", "paciente", "show"));
    }

    public function destroy($id){
        $sesion = Sesion::find($id);
        $sesion->respuesta = null;
        $sesion->fecha_finalizada = null;
        $sesion->observaciones = null;
        $sesion->save();
        return redirect("/pacientes/$sesion->paciente_id/informesSesion");

    }

    public function verInformeSesion($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        return view('informesSesion.show', compact('paciente', 'sesion'));
    }
}
