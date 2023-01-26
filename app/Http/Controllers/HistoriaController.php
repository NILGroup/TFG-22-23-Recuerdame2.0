<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Recuerdo;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Psy\Readline\Hoa\Console;

class HistoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['asignarPaciente'])->except('generarLibroHistoria');
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
    /*
    public function filtrarPorVarias($id, &$listaRecuerdosHistoriaVida , $filtro){
            $listaAux = $listaRecuerdosHistoriaVida;
            $listaAux2 = collect();
            //return $id;
           
                $listaAux = $listaRecuerdosHistoriaVida->whereIn($filtro, $id); //recorremos todas las etiqetas del multifiltro
                $listaAux = array_values($listaAux);
                return $listaAux;
                foreach($listaAux as $item){
                    $listaAux2->push($item);
                }
            
            return $listaAux2;
    }

    public function getListaRecuerdosHistoriaVida($idPaciente, $fechaInicio, $fechaFin, $idEtapa, $idCategoria, $idEtiqueta)
    {
        $paciente = Paciente::find($idPaciente);
        if (is_null($paciente)) return "ID de paciente no encontrada";


        $listaRecuerdosHistoriaVida = $paciente->recuerdos;
        $listafinal=collect();
        
        if (!empty($idCategoria)){
            $listaRecuerdosHistoriaVida= $this->filtrarPorVarias($idCategoria, $listaRecuerdosHistoriaVida, 'categoria_id');
            return $listaRecuerdosHistoriaVida;
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
    }*/

    public function generarLibroHistoria(Request $request)
    {
        $idPaciente = $request->paciente_id;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapa;
        $idEtiqueta = $request->seleccionEtiq;
        $idCategoria = $request->seleccionCat;
        $apto = $request->apto;
        $noApto = $request->noApto;
        $paciente = Paciente::find($idPaciente);
       
        if (is_null($idEtapa) && is_null($idEtiqueta) && is_null($idCategoria)) {
            if ($apto == 1 && $noApto == 1) { //si queremos todos los recuerdos
                $listaRecuerdos = $paciente->recuerdos()->get();
          
            /*si solo queremos los recuerdos aptos apto=1, si solo queremos los no aptos
            apto será = 0 , por tanto siempre que haya uno OOOO lo otro se hace esta consulta */
            } else { 
                $listaRecuerdos = $paciente->recuerdos()->where("apto", $apto)->get();
            }
            return view("historias.generarLibro", compact("fechaInicio", "fechaFin", "listaRecuerdos"));
        } else {
            if (is_null($idEtapa))
                $idEtapa = Etapa::select('id');
            if (is_null($idEtiqueta))
                $idEtiqueta = Etiqueta::select('id');
          
            if (is_null($idCategoria))
                $idCategoria = Categoria::select('id');
        }
        
        if (is_null($paciente)) return "ID de paciente no encontrada";

        //apto o/y no apto
        if ($apto == 1 || $noApto == 1) {
            $listaRecuerdos = $paciente->recuerdos()->where("apto", $apto)->get();
        } else { //si queremos todos los recuerdos
            $listaRecuerdos = $paciente->recuerdos()->get();
        }
        
        $listaRecuerdos =  $listaRecuerdos
            ->whereIn('etapa_id', $idEtapa)
            ->whereIn('etiqueta_id', $idEtiqueta)
            ->whereIn('categoria_id', $idCategoria)
            ->get();
  
        $listaRecuerdos = $listaRecuerdos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        //return $listaRecuerdos;

        return view("historias.generarLibro", compact("fechaInicio", "fechaFin", "listaRecuerdos"));
    }
}
