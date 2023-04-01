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


        //OBTENER LOS RECUERDOS BUSCADOS///////////////////////////////////////////////////
        $idPaciente = $request->paciente_id;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapa;
        $idEtiqueta = $request->seleccionEtiq;
        $idCategoria = $request->seleccionCat;
        $apto = $request->apto;
        $noApto = $request->noApto;
        $imagenesCheck= $request->imagenesCheck;
        $videosCheck= $request->videosCheck;
        $narracionCheck = $request->narracionCheck;
        $paciente = Paciente::find($idPaciente);

        if(!$imagenesCheck && !$videosCheck){
            $imagenesCheck = true; $videosCheck = true;
        }

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

        
        $videosArray = collect();         $imagesArray = collect();
        foreach ($listaRecuerdos as $rc) { //¿Vacio?
            foreach($rc->multimedias as $media){
                $extension = pathinfo($media->fichero, PATHINFO_EXTENSION);
                $rememberpath = env("NGROK")."/TFG-22-23-Recuerdame2.0/public".$media->fichero;//str_replace('/storage/', '/public/', $media->fichero);
                
                if($extension == 'png' || $extension == 'jpg'){
                    $imagesArray->push($rememberpath);
                }

                if($extension == 'mp4' || $extension == 'avi'){
                    $videosArray->push($rememberpath);
                }
            }
        }

            $VideoGenerator = new VideoHistoriaVida();
            $url = $VideoGenerator->generateAudio("Hola grupo de Recuerdame 2, soy una IA muy muy molona esquereee xd");
            //$url = $VideoGenerator->generateVideo($videosArray->toArray(), $imagesArray->toArray(), $imagenesCheck, $videosCheck, $narracionCheck);
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
}
