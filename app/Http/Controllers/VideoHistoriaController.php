<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Mail\videoMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Video;
use App\Models\User;
use App\VideoHistoriaVida;


class VideoHistoriaController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role'])->except(['renderResponse']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore','renderResponse']);
    }
    public function show($idPaciente,$idVideo)
    {
        $video = Video::find($idVideo);
        $url = $video->url;   
        return view("videos.videoPlayer", compact("url"));
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
        $idEtapas = $idEtapa;
        if (is_null($idEtapa)){
            $idEtapa = Etapa::select('id')->get();
            $idTodasEtapas = $idEtapa;
            for ($i = 0; $i < sizeOf($idTodasEtapas); $i++) {
                $idEtapas[$i] = $idTodasEtapas[$i]['id'];
            }

        }
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

        //NOMBRE VÍDEO
        $titulo = "";

        if (is_null($idEtapas)){
            $titulo = $titulo .  "de todas las etapas ";
        }else{
            for ($i = 0; $i < sizeof($idEtapas); $i++) {
                $titulo = $titulo . Etapa::find($i + 1)['nombre'];
                if($i < sizeOf($idEtapa) - 1)
                    $titulo = $titulo . " - ";
            }
        } 
            
        if($narracionCheck){
            $titulo = $titulo .  " con narración";
        }
        $titulo = "Vídeo " . $titulo; 
        //FIN NOMBRE

        //PATH

        
        $videosArray = collect();         $imagesArray = collect();
        foreach ($listaRecuerdos as $rc) { //¿Vacio?
            foreach($rc->multimedias as $media){
                $extension = pathinfo($media->fichero, PATHINFO_EXTENSION);
                $rememberpath = "http://".env('APP_URL').$media->fichero;//Storage::url(str_replace('storage/' ,'', $media->fichero));//env("APP_URL").$media->fichero;
                
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg'){
                    $imagesArray->push($rememberpath);
                }

                if($extension == 'mp4' || $extension == 'avi'){
                    $videosArray->push($rememberpath);
                }
            }
        }

            $VideoGenerator = new VideoHistoriaVida();
            //$url = $VideoGenerator->generateAudio("Test test test");

            $VideoGenerator->generateVideo($titulo, $videosArray->toArray(), $imagesArray->toArray(), $imagenesCheck, $videosCheck, $narracionCheck, $listaRecuerdos, $idPaciente);

            return redirect("/usuarios/$idPaciente/videos");
    
    }

    public function showByPaciente($idPaciente){
        $paciente = Paciente::find($idPaciente);
        if (is_null($paciente)) return "ID de usario no encontrada"; //ESTUDIAR SI SOBRA

        $videos = $paciente->videos;
        //Devolvemos los recuerdos
        return view("videos.showByPaciente", compact("videos", "paciente"));
    }

    public function destroy($idVideo){
        $video = Video::find($idVideo);
        $video->delete();   
    }

    public function restore($idVideo) {
        Video::where('id', $idVideo)->withTrashed()->restore();
    }

    public function renderResponse(Request $request){

        // $videos = Video::where('crea_id', $request->id)->get();
        // if($videos->count() > 0){
        //     $video = $videos->first();
        //     $userId = $video->paciente_id; 
        //     $usuario = User::find($userId);
        //     Mail::to($usuario->email)->send(new VideoMail());

        //     $videoNew = Video::updateOrCreate(
        //         ['id' => $video->id],
        //         [
        //             'url' => $video->url,
        //             'estado' => $request->status == "succeeded"?"Finalizado":"Error",
        //             'paciente_id' => $userId,
        //             'crea_id' => $video->crea_id
        //         ]
        //     );

        //     return "Hecho";
        // }else{
        //     return response()->json(['error' => 'External API call failed.'], 500);
        // }

    }

}
