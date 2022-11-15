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
    public function __construct()
    {
        $this->middleware(['auth', 'asignarPaciente']);
    }

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

    public function filtrarPorVarias($id, &$listaRecuerdosHistoriaVida , $filtro){
            $listaAux = $listaRecuerdosHistoriaVida;
            $listaAux2 = collect();
            foreach( $id as $et){
                $listaAux = $listaRecuerdosHistoriaVida->where($filtro, $et);
                foreach($listaAux as $item){
                    $listaAux2->push($item);
                }
            }
            return $listaAux2;
    }

    public function getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta)
    {
        $paciente = Paciente::find($idPaciente);
        if (is_null($paciente)) return "ID de paciente no encontrada";

        $listaRecuerdosHistoriaVida = Recuerdo::where('paciente_id', $idPaciente)->get();
        $listafinal=collect();
        if (!empty($idCategoria)){
            $listaRecuerdosHistoriaVida= $this->filtrarPorVarias($idCategoria, $listaRecuerdosHistoriaVida, 'categoria_id');
        }
        if (!empty($idEtapa)){
            $listaRecuerdosHistoriaVida= $this->filtrarPorVarias($idEtapa, $listaRecuerdosHistoriaVida, 'etapa_id');
            
        }
        if (!empty($idEtiqueta)){
            $listaRecuerdosHistoriaVida= $this->filtrarPorVarias($idEtiqueta, $listaRecuerdosHistoriaVida, 'etiqueta_id');
        }

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

        $idCategoria = $request->seleccionCat;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapa;
        $idEtiqueta = $request->seleccionEtiq;
        $idPaciente = $request->paciente_id;
     
        $Nombresetapas = collect();
        if($idEtapa!=null){
            foreach( $idEtapa as $et){
                $Nombresetapas->prepend(Etapa::find($et)->nombre);
            }
        }

        $Nombrescat = collect();
        if($idCategoria!=null){
            foreach( $idCategoria as $et){
            $Nombrescat->prepend(Categoria::find($et)->nombre);
            }
        }

        
        $Nombresetiquetas = collect();
        if($idEtiqueta!=null){
            foreach( $idEtiqueta as $et){
            $Nombresetiquetas->prepend(Etiqueta::find($et)->nombre);
            }
        }


        $listaRecuerdos = $this->getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta);
        //return $listaRecuerdos ;
        return view("historias.generarLibro", compact("Nombrescat", "fechaInicio", "fechaFin", "Nombresetapas", "Nombresetiquetas", "listaRecuerdos"));
    }
}
