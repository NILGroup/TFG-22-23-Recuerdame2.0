<?php
    namespace App;
require base_path('vendor/autoload.php');

    use App\Jobs\VideoPost;

    class VideoHistoriaVida{

        function generateVideo($videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck, $listaRecuerdos){

            VideoPost::dispatch($videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck, $listaRecuerdos);  



                return "lmao";//$renders[0];
            
        }

    }
