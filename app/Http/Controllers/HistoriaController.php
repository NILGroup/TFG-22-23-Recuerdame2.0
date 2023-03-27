<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;
use ProtoneMedia\LaravelFFMpeg\Exporters\EncodingException;
use Illuminate\Support\Facades\Storage;
use FFMpeg\Filters\AdvancedMedia\ComplexFilters;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Filters\Video\VideoFilters;
use FFMpeg\Format\Video\X264;
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


        //OBTENER LOS RECUERDOS BUSCADOS///////////////////////////////////////////////////
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
        //FIN. RECUERDOS YA OBTENIDOS///////////////////////////////////////////////////

        //PATH
        $path = 'public\img\HistoriaVidaCache\\'.$idPaciente.'.mp4';

        if(Storage::exists($path)){
            Storage::delete($path);
        }
        
        $array = collect();
        $trashCache = collect();
        foreach ($listaRecuerdos as $rc) { //¿Vacio?
            foreach($rc->multimedias as $media){
                $extension = pathinfo($media->fichero, PATHINFO_EXTENSION);
                $rememberpath = str_replace('/storage/', '/public/', $media->fichero);
                
                    if($extension == 'jpg'){
                        //$uniqueName = uniqid() . time() .'.mp4';
                        //FFMpeg::open($rememberpath)
                        //->export()
                        //->asTimelapseWithFramerate(0.3)
                        //->inFormat(new \FFMpeg\Format\Video\X264())
                        //->save('public\img\HistoriaVidaCache\imgToMp4\\'.$uniqueName);
                        //$trashCache->push('public\img\HistoriaVidaCache\imgToMp4\\'.$uniqueName);
                        //$array->push('\public\img\HistoriaVidaCache\imgToMp4\\'.$uniqueName);
                    }

                if($extension == 'mp4'){
                    $array->push($rememberpath);
                }
            }
        }
        
        //print_r($array);


            FFMpeg::fromDisk('local')
            ->open($array->toArray())
            ->export()
            ->concatWithoutTranscoding()
            ->save($path);

            FFMpeg::cleanupTemporaryFiles();


            //Url to final Video
            $path = \Illuminate\Support\Facades\URL::to('storage/img/HistoriaVidaCache/'.$idPaciente.'.mp4');
            return view("historias.videoPlayer", compact("path"));

    
    }


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
