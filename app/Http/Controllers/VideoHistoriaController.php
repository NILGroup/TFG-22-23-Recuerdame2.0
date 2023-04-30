<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use App\VideoHistoriaVida;

class VideoHistoriaController extends Controller
{
    public function generadorVideoHistoria(int $idPaciente)
    {
        $paciente = Paciente::findOrFail($idPaciente);
        $fecha = "11/12/2021";
        $etapas = Etapa::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");

        return view("historias.generateVideoHistoria", compact("paciente", "fecha", "etapas", "etiquetas", "categorias"));
    }
    public function generarVideoHistoria(Request $request){

        $imagenesCheck= $request->imagenesCheck;
        $videosCheck= $request->videosCheck;
        $narracionCheck = $request->narracionCheck;
        if(!$imagenesCheck && !$videosCheck){
            $imagenesCheck = true; $videosCheck = true;
        }
        //OBTENER LOS RECUERDOS BUSCADOS///////////////////////////////////////////////////
        $idPaciente = $request->paciente_id;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapaModal;
        $puntuacion = $request->seleccionEtiqModal;
        $idCategoria = $request->seleccionCatModal;
        $apto = $request->apto;
        $noApto = $request->noApto;
        $paciente = Paciente::find($idPaciente);
        $puntuacionFinal = collect([]);
        if (is_null($idEtapa))
            $idEtapa = Etapa::select('id');
        if (is_null($idCategoria))
            $idCategoria = Categoria::select('id');
        if (is_null($puntuacion)){
            $puntuacionFinal = collect([0,1,2,3,4,5,6,7,8,9,10]);
        }else {
            
            if(in_array("1", $puntuacion))
            {
                $puntuacionFinal->push(6,7,8,9,10);
            }
            if(in_array("2", $puntuacion))
            {
                $puntuacionFinal->push(5);
            }
            if(in_array("3", $puntuacion))
            {
                $puntuacionFinal->push(0,1,2,3,4);
            }
        }
                

        $listaRecuerdos =  $paciente->recuerdos()
        ->where(function($query) use ($idEtapa){
            $query->whereIn('etapa_id', $idEtapa)->orWhereNull('etapa_id');

        })->where(function($query) use ($idCategoria){
            $query->whereIn('categoria_id',$idCategoria)->orWhereNull('categoria_id');         
        })->where(function($query) use ($puntuacionFinal){
            $query ->whereIn('puntuacion', $puntuacionFinal)->orWhereNull('puntuacion');
        
        
        })->where(function($query) use ($fechaInicio,$fechaFin){
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin])->orWhereNull('fecha');
        })
            ->get();

        if(!($apto == 0 && $noApto == 0) && !($apto == 1 && $noApto == 1))
            $listaRecuerdos = $listaRecuerdos
                ->whereIn('apto', $apto);
        //FIN. RECUERDOS YA OBTENIDOS///////////////////////////////////////////////////


        //PATH

        
        $videosArray = collect();         $imagesArray = collect();
        foreach ($listaRecuerdos as $rc) { //¿Vacio?
            foreach($rc->multimedias as $media){
                $extension = pathinfo($media->fichero, PATHINFO_EXTENSION);
                $rememberpath = env("NGROK")."/TFG-22-23-Recuerdame2.0/public".$media->fichero;//str_replace('/storage/', '/public/', $media->fichero);
                
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg'){
                    $imagesArray->push($rememberpath);
                }

                if($extension == 'mp4' || $extension == 'avi'){
                    $videosArray->push($rememberpath);
                }
            }
        }

            $VideoGenerator = new VideoHistoriaVida();
            //$url = $VideoGenerator->generateAudio("Yo que se. Me da igual. PFFFF. Que me da igual");
            $url = $VideoGenerator->generateVideo($videosArray->toArray(), $imagesArray->toArray(), $imagenesCheck, $videosCheck, $narracionCheck);

            //Crear fila en la base de datos
            $video = Video::create(
                [
                    'url' => $url,
                    'estado' => "Procesando",
                    'paciente_id' => $idPaciente,
                ]
            );
    
            return self::showByPaciente($idPaciente);
    
    }

    public function showByPaciente($idPaciente)
    {
        $paciente = Paciente::find($idPaciente);
        if (is_null($paciente)) return "ID de paciente no encontrada"; //ESTUDIAR SI SOBRA

        $videos = $paciente->videos;
        //Devolvemos los recuerdos
        return view("historias.showByPaciente", compact("videos", "paciente"));
    }

    public function destroy($idVideo)
    {
        $video = Video::find($idVideo); //busca el recuerdo en sí
        $video->delete();
        
    }

    public function restore($idVideo) 
    {
        Video::where('id', $idVideo)->withTrashed()->restore();
    }
}
