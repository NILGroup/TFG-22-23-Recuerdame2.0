<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Diagnostico;
use App\Models\Paciente;
use App\Models\Sesion;
use App\Models\Multimedia;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
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
    //Redirige a la vista para generar el informe
    public function generarInforme($idPaciente){
        $paciente = Paciente::find($idPaciente);
        $diagnostico = new Diagnostico();
        $show = false;
        return view('diagnostico.create', compact('paciente', 'diagnostico', 'show'));
    }
    //Almacena el diágnostico en la base de datos
    public function store(Request $request){

        $diagnostico = Diagnostico::updateOrCreate(
            ['id' => $request->id],
            ['paciente_id' => $request->paciente_id,
            'enfermedad' => $request->enfermedad,
            'fecha' => $request->fecha,
            'gds' => $request->gds,
            'gds_fecha' => $request->gds_fecha,
            'mental' => $request->mental,
            'mental_fecha' => $request->mental_fecha,
            'cdr' => $request->cdr,
            'cdr_fecha' => $request->cdr_fecha,
            'antecedentes' => $request->antecedentes,
            'observaciones' => $request->observaciones,
            'nombre_escala' => $request->nombre_escala,
            'escala' => $request->escala,
            'fecha_escala' => $request->fecha_escala
            ]);


        $this->savePhoto($request, $diagnostico, "igds");
        $this->savePhoto($request, $diagnostico, "imec");
        $this->savePhoto($request, $diagnostico, "icdr");
        $this->savePhoto($request, $diagnostico, "icus");
            
        session()->put('created', "true");
        return redirect("usuarios/{$request->paciente_id}/diagnostico");
    }
    //Actualiza el diágnostico en la base de datos
    public function update(Request $request){

        $diagnostico = Diagnostico::updateOrCreate(
            ['id' => $request->id],
            ['paciente_id' => $request->paciente_id,
            'enfermedad' => $request->enfermedad,
            'fecha' => $request->fecha,
            'gds' => $request->gds,
            'gds_fecha' => $request->gds_fecha,
            'mental' => $request->mental,
            'mental_fecha' => $request->mental_fecha,
            'cdr' => $request->cdr,
            'cdr_fecha' => $request->cdr_fecha,
            'antecedentes' => $request->antecedentes,
            'observaciones' => $request->observaciones,
            'nombre_escala' => $request->nombre_escala,
            'escala' => $request->escala,
            'fecha_escala' => $request->fecha_escala
            ]);


        $this->savePhoto($request, $diagnostico, "igds");
        $this->savePhoto($request, $diagnostico, "imec");
        $this->savePhoto($request, $diagnostico, "icdr");
        $this->savePhoto($request, $diagnostico, "icus");
            
        session()->put('created', "true");
        return redirect("usuarios/{$request->paciente_id}/diagnostico");
    }

    //Redirige a la vista del diágnostico
    public function show($id)
    {
        $show = true;
        $paciente = Paciente::find($id);
        if(is_null($paciente->diagnostico)){
            $diagnostico = new Diagnostico();
            return redirect("usuarios/{$id}/crearDiagnostico");
        }
        $diagnostico = $paciente->diagnostico;
        if(!is_null($diagnostico->gds) && !is_null($diagnostico->mental) && !is_null($diagnostico->cdr)){
                
            $fechasNF = $paciente->evaluaciones()->pluck("fecha")->toarray();
            array_unshift($fechasNF, $diagnostico->fecha);
            $fechas = array();
            foreach ($fechasNF as $fecha) {
                $fecha = Carbon::createFromFormat('Y-m-d', $fecha)->format('d/m/Y');
                array_push($fechas,$fecha);
            }

            $gds = $paciente->evaluaciones()->pluck("gds")->toarray();
            array_unshift($gds, $diagnostico->gds);

            $mini = $paciente->evaluaciones()->pluck("mental")->toarray();
            array_unshift($mini, $diagnostico->mental);

            $cdr = $paciente->evaluaciones()->pluck("cdr")->toarray();
            array_unshift($cdr, $diagnostico->cdr);
        }
        else{
            $fechas = array();
            $gds = array();
            $mini = array();
            $cdr = array();
        }

        return view('diagnostico.show', compact('diagnostico', 'paciente', 'show', 'fechas', 'gds', 'mini', 'cdr'));
    }

    public function showEditable($id)
    {
        $show = false;
        $paciente = Paciente::find($id);
        $diagnostico = $paciente->diagnostico;
        return view('diagnostico.edit', compact('diagnostico', 'paciente', 'show'));
    }
    

    //foto puede ser : gds mec cdr cus. Guarda la foto.
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
