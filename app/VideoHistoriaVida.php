<?php
    namespace App;
    require __DIR__.'/../vendor/autoload.php';

    use Creatomate\Client;
    use Creatomate;

use function PHPUnit\Framework\isNull;

    class VideoHistoriaVida{

        function generateVideo($videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck){
            $apikey = env("CREATOMATE_KEY");
            if($apikey.isNull()){
                return null;
            }else{
                $client = new Client($apikey);
                $resultArray = collect();

                if($videosCheck){
                    foreach ($videosArray as $ficheroURL) {
                        $resultArray->push(new Creatomate\Elements\Video([
                            'track' => 1,
                            'source' => $ficheroURL,
                        ]));
                    } 
                }

                if($imagenesCheck){
                    foreach ($imagesArray as $ficheroURL) {
                        $resultArray->push(new Creatomate\Elements\Image([
                            'source' => $ficheroURL,
                            "track"=> 1,
                            "duration"=> 5,
                            'animations' => [
                                new Creatomate\Animations\PanCenter([
                                    'start_scale' => '100%',
                                    'end_scale' => '120%',
                                    'easing' => 'linear',
                                ]),
                            ],
                        ]));
                    }

                    $resultArray->push(new Creatomate\Elements\Audio([
                        'source' => 'env("NGROK")."/TFG-22-23-Recuerdame2.0/public/audio/video_background_music.wav',
                        // Make the audio track as long as the output
                        'duration' => null,
                        // Fade out for 2 seconds
                        'audio_fade_out' => 2,
                    ]));
                }
                
                if($resultArray->isEmpty()){
                    return "ERROR";
                }else{
                    $source = new Creatomate\Source([
                        'output_format' => 'mp4',
                        'width' => 1280,
                        'height' => 720,
                        'elements' => $resultArray->toArray(),
                    ]);
    
                    $renders = $client->render(['source' => $source]);
                }

                //print_r($renders[0]['url']);
                return $renders[0]['url'];
            }
        }


    }
