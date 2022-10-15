<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Paciente;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
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
        $evaluaciones = Evaluacion::where('paciente_id',$idPaciente)->get();
        $paciente = $evaluaciones[0]->paciente;
        return view("evaluaciones.showByPaciente", compact('evaluaciones', 'paciente'));
    }
    public function generarInforme($idPaciente){
        $paciente = Paciente::find($idPaciente);
        return view('evaluaciones.create', compact('paciente'));
    }

    public function store(Request $request){

        $evaluacion = Evaluacion::updateOrCreate(
            ['id' => $request->id],
            ['paciente_id' => $request->paciente_id,
             'fecha' => $request->fecha,
             'gds' => $request->gds,
             'gds_fecha' => $request->gds_fecha,
             'mental' => $request->mental,
             'mental_fecha' => $request->mental_fecha,
             'cdr' => $request->cdr,
             'cdr_fecha' => $request->cdr_fecha,
             'diagnostico' => $request->diagnostico,
             'observaciones' => $request->observaciones
            ]);
        if($request->nombre_escala != null){
            $evaluacion->nombre_escala = $request->nombre_escala;
            $evaluacion->escala = $request->escala;
            $evaluacion->fecha_escala = $request->fecha_escala;
            $evaluacion->save();
        }
        return redirect("pacientes/{$evaluacion->paciente_id}/evaluaciones");
    }

    public function showEditable($id, $idE)
    {
        $evaluacion = Evaluacion::findOrFail($idE);
        $paciente = $evaluacion->paciente;
        return view('evaluaciones.edit', compact('evaluacion', 'paciente'));
    }
    
    public function destroy($id){
        $evaluacion = Evaluacion::find($id);
        $paciente_id = $evaluacion->paciente_id;
        $evaluacion->delete();
        return redirect("/pacientes/$paciente_id/evaluaciones");

    }
    /*

    public function verInformeEvaluacion($idPaciente, $idEvaluacion){
        $evaluacion = Evaluacion::find($idEvaluacion);
        $paciente = $sesion->paciente;
        return view('evaluaciones.show', compact('paciente', 'evaluacion'));
    }
    */
}
