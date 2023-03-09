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
use FFMpeg\Filters\AdvancedMedia\ComplexFilters;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Exporters\EncodingException;
use Illuminate\Support\Facades\Storage;

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

    public function generarVideoHistoria(Request $request){
        $path = 'public\img\HistoriaVidaCache\\'.$request->paciente_id.'.mp4'; 
        if(Storage::exists($path)){
            Storage::delete($path);
        }

        try {
            FFMpeg::fromDisk('local')
            ->open(['public\img\1.mp4', 'public\img\2.mp4'])
            ->export()
            ->concatWithoutTranscoding()
            ->save($path);
            FFMpeg::cleanupTemporaryFiles();
            $path = storage_path().'\\app\\'.$path;
            return view("historias.videoPlayer", compact("path"));
        } catch (EncodingException $exception) {
            $command = $exception->getCommand();
            $errorLog = $exception->getErrorOutput();
            return "La generación del vídeo ha fallado. Póngase en contacto con soporte.";
        }
   
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
      
        if (is_null($idEtapa))
            $idEtapa = Etapa::select('id');
        if (is_null($idEtiqueta))
            $idEtiqueta = Etiqueta::select('id');
        if (is_null($idCategoria))
            $idCategoria = Categoria::select('id');

        $listaRecuerdos =  $paciente->recuerdos()
            ->whereIn('etapa_id', $idEtapa)->orWhereNull('etapa_id')
            ->whereIn('etiqueta_id', $idEtiqueta)->orWhereNull('etiqueta_id')
            ->whereIn('categoria_id', $idCategoria)->orWhereNull('categoria_id')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();
        
        if(!($apto == 0 && $noApto == 0) && !($apto == 1 && $noApto == 1))
            $listaRecuerdos = $listaRecuerdos
                ->whereIn('apto', $apto);
        return view("historias.generarLibro", compact("fechaInicio", "fechaFin", "listaRecuerdos"));
    }
}
