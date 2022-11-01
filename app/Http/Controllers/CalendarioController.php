<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
        $this->middleware('esCuidadorDe')->only('showByPaciente');
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
        Actividad::create([
            "start" => $request->start,
            "title" => $request->title,
            "paciente_id" => $request->idPaciente,
            "color" => $request->color,
            "description" => $request->obs
        ]);

        return redirect("/pacientes/$request->idPaciente/calendario");
    }

    public function update(Request $request)
    {
        
        $actividad = Actividad::findOrFail($request->id);
        $actividad->update($request->all());

        return redirect("/pacientes/$request->idPaciente/calendario");


    }

    public function show(int $idPaciente) {
        $actividad = Actividad::where("paciente_id","=",$idPaciente)->get();
        return response()->json($actividad);
    }

    public function destroy(Request $request)
    {
        $actividad = Actividad::findOrFail($request->id);
        $paciente = $actividad->paciente_id;
        $actividad->delete();

        return redirect("/pacientes/$paciente/calendario");

    }
}
