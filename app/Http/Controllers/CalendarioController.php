<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function showByPaciente(int $idPaciente) {
        $actividades = Actividad::all();
        return view('calendario.showByPaciente', compact("idPaciente", "actividades"));
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
            "paciente_id" => $request->id,
            "color" => $request->color,
            "description" => $request->obs
        ]);

        return redirect("/pacientes/$request->id/calendario");
    }

    public function show(Actividad $actividad) {
        /*$actividad = Actividad::all();
        return response()->json($actividad);*/
    }
}
