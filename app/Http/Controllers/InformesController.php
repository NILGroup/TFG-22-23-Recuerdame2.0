<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;

class InformesController extends Controller
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
        return view('informesSesion.generarInforme', compact('paciente', 'sesion'));
    }

    public function cerrarInforme(Request $request){
        $sesion = Sesion::find($request->id);
        $sesion->fecha = $request->fecha;
        $sesion->fecha_finalizada = $request->fecha_finalizada;
        $sesion->respuesta = $request->respuesta;
        $sesion->observaciones = $request->observaciones;
        $sesion->save();
        return redirect("pacientes/{$sesion->paciente->id}/sesiones");
    }

    public function destroy($id){
        $sesion = Sesion::find($id);
        $sesion->respuesta = null;
        $sesion->fecha_finalizada = null;
        $sesion->observaciones = null;
        $sesion->save();
        return redirect("/pacientes/$sesion->paciente_id/informes");

    }

    public function verInforme($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        return view('informesSesion.verInforme', compact('paciente', 'sesion'));
    }
}
