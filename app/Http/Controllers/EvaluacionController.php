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
        $paciente = Paciente::find($idPaciente);
        return view("evaluaciones.showByPaciente", compact('evaluaciones', 'paciente'));
    }
    public function generarInforme($idPaciente){
        $paciente = Paciente::find($idPaciente);
        $evaluacion = new Evaluacion();
        $show = false;
        return view('evaluaciones.create', compact('paciente', 'evaluacion', 'show'));
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
             'observaciones' => $request->observaciones,
             'nombre_escala' => $request->nombre_escala,
             'escala' => $request->escala,
             'fecha_escala' => $request->fecha_escala
            ]);
        return redirect("pacientes/{$evaluacion->paciente_id}/evaluaciones/$evaluacion->id/ver");
    }

    public function show($id, $idE)
    {
        $show = true;
        $evaluacion = Evaluacion::findOrFail($idE);
        $paciente = $evaluacion->paciente;
        return view('evaluaciones.show', compact('evaluacion', 'paciente', 'show'));
    }

    public function showEditable($id, $idE)
    {
        $show = false;
        $evaluacion = Evaluacion::findOrFail($idE);
        $paciente = $evaluacion->paciente;
        return view('evaluaciones.edit', compact('evaluacion', 'paciente', 'show'));
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
