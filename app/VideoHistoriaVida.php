<?php
    namespace App;
require base_path('vendor/autoload.php');

    use App\Jobs\VideoPost;
    use App\Models\Video;
    use App\Models\User;
    class VideoHistoriaVida{

        function generateVideo($titulo, $videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck, $listaRecuerdos, $idPaciente){
            $video = Video::create(
                [
                    'nombre' => $titulo,
                    'estado' => "Procesando",
                    'paciente_id' => $idPaciente,
                ]
            );

            VideoPost::dispatch($video,$videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck, $listaRecuerdos, $idPaciente);  
        }

    }
