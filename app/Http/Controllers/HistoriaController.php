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
        if ($memory != null) return $memory->fecha;
    }

    public function generarHistoria(int $idPaciente)
    {
        $paciente = Paciente::findOrFail($idPaciente);
        $fecha = $this->oldestMemoryDate($idPaciente);
        $etapas = Etapa::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");

        return view("historias.generateHistoria", compact("paciente", "fecha", "etapas", "etiquetas", "categorias"));
    }

    public function getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta)
    {
        $paciente = Paciente::find($idPaciente);
        if (is_null($paciente)) return "ID de paciente no encontrada";

        $listaRecuerdosHistoriaVida = Recuerdo::where('paciente_id', $idPaciente)->get();
        $listafinal=collect();
        if (!empty($idCategoria))
            $listaRecuerdosHistoriaVida = $listaRecuerdosHistoriaVida->where('categoria_id', $idCategoria);
        if (!empty($idEtapa))
            $listaRecuerdosHistoriaVida = $listaRecuerdosHistoriaVida->where('etapa_id', $idEtapa);
        if (!empty($idEtiqueta))
            $listaAux = $listaRecuerdosHistoriaVida;
            $listaAux2 = collect();
            foreach( $idEtiqueta as $et){
                $listaAux = $listaRecuerdosHistoriaVida->where('etiqueta_id', $et);
                foreach($listaAux as $item){
                    $listaAux2->push($item);
                }
            }
            $listaRecuerdosHistoriaVida=$listaAux2;
        if (!empty($fechaInicio)){
            foreach ($listaRecuerdosHistoriaVida as $recuerdo) {
                if($recuerdo->fecha  >= $fechaInicio){
                    $listafinal= $listafinal->prepend($recuerdo);
                }
            }
            $listaRecuerdosHistoriaVida=  $listafinal->reverse();
            $listafinal=collect();
        }
        if (!empty($fechaFin)){
            foreach ($listaRecuerdosHistoriaVida as $recuerdo) {
                if($recuerdo->fecha  <= $fechaFin){
                    $listafinal= $listafinal->prepend($recuerdo);
                }
            }
            $listaRecuerdosHistoriaVida=  $listafinal->reverse();
            $listafinal=collect();
        }
      
        return $listaRecuerdosHistoriaVida;
    }

    public function generarLibroHistoria(Request $request)
    {

        $idCategoria = $request->idCategoria;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->idEtapa;
        $idEtiqueta = $request->seleccion;
        $idPaciente = $request->paciente_id;

        $etapa = null;
        if($idEtapa!=null)$etapa = Etapa::find($idEtapa)->nombre;

        $categoria = null;
        if($idCategoria!=null)$categoria = Categoria::find($idCategoria)->nombre;
        
        $Nombresetiquetas = collect();
        if($idEtiqueta!=null){
            foreach( $idEtiqueta as $et){
            $Nombresetiquetas->prepend(Etiqueta::find($et)->nombre);
            }
        }

        $listaRecuerdos = $this->getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta);
        return view("historias.generarLibro", compact("categoria", "fechaInicio", "fechaFin", "etapa", "Nombresetiquetas", "listaRecuerdos"));
    }
}
