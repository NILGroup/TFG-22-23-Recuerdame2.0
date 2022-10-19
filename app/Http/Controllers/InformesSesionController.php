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
        throw new \Exception("a");
        $sesiones = Sesion::where('paciente_id',$idPaciente)->whereNotNull("fecha_finalizada")->get();
        return view("informesSesion.showByPaciente", compact('sesiones'));
    }

    public function generarInforme($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        return view('informesSesion.create', compact('paciente', 'sesion'));
    }

    public function cerrarInformeSesion(Request $request){
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
        return redirect("/pacientes/$sesion->paciente_id/informesSesion");

    }

    public function verInformeSesion($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
        $paciente = $sesion->paciente;
        return view('informesSesion.show', compact('paciente', 'sesion'));
    }
}
