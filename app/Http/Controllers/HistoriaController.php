<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Recuerdo;

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

    public function getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta)
    {
        $paciente =Paciente::find($idPaciente);
        if(is_null($paciente)) return "ID de paciente no encontrada"; 
      
     
        $listaRecuerdosHistoriaVida =Recuerdo::where('paciente_id',$idPaciente)->get();
        
        if(!empty($idCategoria ))
            $listaRecuerdosHistoriaVida = $listaRecuerdosHistoriaVida->where('categoria_id',$idCategoria);
        if(!empty($idEtapa ))
            $listaRecuerdosHistoriaVida = $listaRecuerdosHistoriaVida->where('etapa_id',$idEtapa);
        if(!empty($idEtiqueta ))
            $listaRecuerdosHistoriaVida = $listaRecuerdosHistoriaVida->where('etiqueta_id',$idEtiqueta);
   
        return $listaRecuerdosHistoriaVida;
    }

      public function generarLibroHistoria(Request $request) {
        
        $idCategoria = $request->idCategoria;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->idEtapa;
        $idEtiqueta = $request->idEtiqueta;
        $idEtiqueta = $request->idEtiqueta;
        $idPaciente = $request->paciente_id;
       
        
       $listaRecuerdos= $this->getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta);
       
       return view("historias.generarLibro", compact("idCategoria","fechaInicio","fechaFin","idEtapa","idEtiqueta","listaRecuerdos"));
        
    }

}
