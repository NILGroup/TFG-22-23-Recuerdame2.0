<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Paciente;
use App\Models\Sesion;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalendarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'asignarPaciente']);
    }

    public function showByPaciente(int $idPaciente) {
        //$actividades = Actividad::all()->sortBy("id");
        return view('calendario.showByPaciente', compact("idPaciente"));
    }

    public function store(Request $request) {
        //throw new \Exception("{$request->start}");
       /*$validate = $request->validate([
            "start" => "required",
            "title" => "required",
            "paciente_id" => "required",
            "color" => "required",
            "description" => "required"
        ]);
*/
        $actividad = Actividad::create([
            "start" => $request->start,
            "title" => $request->title,
            "paciente_id" => $request->idPaciente,
            "color" => $request->color,
            "description" => $request->obs
        ]);

        return redirect("/pacientes/$actividad->paciente_id/calendario");
    }

    public function update(Request $request)
    {
        
        $actividad = Actividad::findOrFail($request->id);
        $actividad->update($request->all());

        return redirect("/pacientes/$actividad->paciente_id/calendario");


    }

    public function show(int $idPaciente) {
     
        $actividad = Actividad::where("paciente_id","=",$idPaciente)->get();
        $sesion = Sesion::where("paciente_id","=",$idPaciente)->get();
        foreach($actividad as $a){
            $a->tipo = "a";
        }
        foreach($sesion as $s){
            $s->tipo = "s";
            $s->start = $s->fecha;
        }
        $sesionYactividad = $actividad->concat($sesion);
        $sesionYactividad->all();

        /**** CREA UN FICHERO PRUEBAS.JSON EN PUBLIC PARA VER QUE JSON SE OBTIENE, pruebas*********
        $filename = "PRUEBAS.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $sesionYactividad->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'PRUEBAS.json',$headers);
        */
        return response()->json($sesionYactividad);
    }

    public function destroy(Request $request)
    {
        $actividad = Actividad::findOrFail($request->id);
        $paciente = $actividad->paciente_id;
        $actividad->delete();

        return redirect("/pacientes/$paciente/calendario");

    }
}
