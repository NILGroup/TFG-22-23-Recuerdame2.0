<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;

class HistoriaController extends Controller
{

    public function oldestMemoryDate($idPaciente)
    {
        
        $memory = Paciente::find($idPaciente)->recuerdos
                                                ->sortBy('fecha')
                                                ->first();
        return $memory->fecha;
    }

    public function generarHistoria(int $idPaciente) {
    $paciente = Paciente::findOrFail($idPaciente); 
    $fecha= $this->oldestMemoryDate($idPaciente);
    $etapas = Etapa::all();
    $categorias = Categoria::all();
    $etiquetas = Etiqueta::all();
       
    return view("historias.generateHistoria", compact("paciente", "fecha","etapas" ,"etiquetas","categorias" ));
    }

   

      public function generarLibroHistoria(Request $request) {
        //$paciente = Paciente::findOrFail($id);
        
        //$users = User::where("rol_id","=",1)->get();

        return redirect("historias.generarLibro");
    }
}
