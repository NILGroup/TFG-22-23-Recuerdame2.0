<?php
    namespace App;
require base_path('vendor/autoload.php');

    use App\Jobs\VideoPost;
    use App\Models\Video;
    use App\Models\User;
    class VideoHistoriaVida{
        //Crea la fila en la BBDD para luego ser actualizada y comienza el trabajo de forma asíncrona para crear el vídeo
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
