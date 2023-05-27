<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Paciente;
use App\Models\Sesion;
use App\Models\Multimedia;
use App\Models\InformeSesion;
use Illuminate\Http\Request;

/* Este controlador hace referencia a los informes de seguimiento */
class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
    }
    
    /*
    * Muestra la lista de Informes de Seguimiento del paciente.
    */
    public function showByPaciente($idPaciente){
        $paciente = Paciente::find($idPaciente);
        $evaluaciones = $paciente->evaluaciones->sortBy("fecha");
        /*
        * TODO: Revisar por qué no muestra correctamente el número de informes de sesión entre evaluaciones
        * Seguramente por la adición del diagnóstico inicial.
        */
        $fechaAnterior = \Carbon\Carbon::parse($paciente->fecha_inscripcion)->format("Y-m-d h:i:s");
        foreach($evaluaciones as $evaluacion){
            $fechaActual = \Carbon\Carbon::parse($evaluacion->fecha)->addDays(1)->format("Y-m-d h:i:s");
            $sesiones = InformeSesion::whereBetween("fecha_finalizada", [$fechaAnterior, $fechaActual])->get();
            $evaluacion->numSesiones = count($sesiones);
            $fechaAnterior=$fechaActual;
        }
        return view("evaluaciones.showByPaciente", compact('evaluaciones', 'paciente'));
    }
    
    /*
    * Redirige a la vista de creación de un informe de seguimiento
    */
    public function generarInforme($idPaciente){
        $paciente = Paciente::find($idPaciente);
        $evaluacion = new Evaluacion();
        $show = false;
        return view('evaluaciones.create', compact('paciente', 'evaluacion', 'show'));
    }

    /*
    * Guarda el nuevo informe de seguimiento
    */
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


        $this->savePhoto($request, $evaluacion, "igds");
        $this->savePhoto($request, $evaluacion, "imec");
        $this->savePhoto($request, $evaluacion, "icdr");
        $this->savePhoto($request, $evaluacion, "icus");
            
        session()->put('created', "true");
        return redirect("usuarios/{$evaluacion->paciente_id}/evaluaciones");
    }

    /*
    * Actualiza el informe de seguimiento seleccionado
    */
    public function update(Request $request){

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

        $this->savePhoto($request, $evaluacion, "igds");
        $this->savePhoto($request, $evaluacion, "imec");
        $this->savePhoto($request, $evaluacion, "icdr");
        $this->savePhoto($request, $evaluacion, "icus");
            
        session()->put('created', "true");
        return redirect("usuarios/{$evaluacion->paciente_id}/evaluaciones/$evaluacion->id/ver");
    }

    
    /*
    * Redirige a la visualización del informe de seguimiento
    */
    public function show($id, $idE)
    {
        $show = true;
        $evaluacion = Evaluacion::findOrFail($idE);
        $paciente = $evaluacion->paciente;
        return view('evaluaciones.show', compact('evaluacion', 'paciente', 'show'));
    }

    /*
    * Redirige a la vista de edición de un informe de seguimiento
    */
    public function showEditable($id, $idE)
    {
        $show = false;
        $evaluacion = Evaluacion::findOrFail($idE);
        $paciente = $evaluacion->paciente;
        return view('evaluaciones.edit', compact('evaluacion', 'paciente', 'show'));
    }
    
    /*
    * Elimina el informe de seguimiento seleccionado
    */
    public function destroy($id){
        $evaluacion = Evaluacion::find($id);
        $paciente_id = $evaluacion->paciente_id;
        $evaluacion->delete();

    }

    /*
    * Deshace la eliminación del informe seleccionado seleccionado
    */
    public function restore($idP, $id) 
    {
        Evaluacion::where('id', $id)->withTrashed()->restore();
    }

    /*
    * Aunque se llame savePhoto, guarda los informes de las escalas: gds mec cdr cus...
    */
    public static function savePhoto(Request $request, $objeto, $foto){
        $name = [];
        $original_name = [];
        if ($request->has($foto)){
            $value = $request->file($foto);
            $image = uniqid() . time() . '.' . $value->getClientOriginalExtension();
                error_log($image);
                $destinationPath = public_path() . '/storage/img';
                $value->move($destinationPath, $image);
                $name[] = $image;
                $original_name[] = $value->getClientOriginalName();                
                $multimedia = new Multimedia([
                    'nombre' => $value->getClientOriginalName(),
                    'fichero' => '/storage/img/' . $image
                ]);
                $multimedia->save();
                if ($foto == "igds")
                    $multimedia->evaluacion_gds()->save($objeto);
                else if ($foto == "imec")
                    $multimedia->evaluacion_mec()->save($objeto);
                else if ($foto == "icdr")
                    $multimedia->evaluacion_cdr()->save($objeto);
                else if ($foto == "icus")
                    $multimedia->evaluacion_custom()->save($objeto);
        }
    }
}
