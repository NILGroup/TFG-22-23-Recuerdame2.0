<?php
    namespace App;
    require '/www/wwwroot/recuerdame2.ddns.net/vendor/autoload.php';

    use Creatomate\Client;
    use Creatomate;
    use duncan3dc\Speaker\TextToSpeech;
    use duncan3dc\Speaker\Providers\VoiceRssProvider;
    use wapmorgan\Mp3Info\Mp3Info;
    use App\ResumenHistoriaVida;
    class VideoHistoriaVida{

        function generateVideo($videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck, $listaRecuerdos){
            $apikey = env("CREATOMATE_KEY");
            if($apikey == null){
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
                            'source' => "https://recuerdame2.ddns.net/renderVideo/1?id=78e914b0-64de-4980-af40-a7a6a9b011ce&url=https://cdn.creatomate.com/renders/f2d70434-a3a4-491a-9a78-fd6281ce99ff.mp4",//$ficheroURL,
                            "track"=> 1,
                            "duration"=> 8,
                            'animations' => [
                                new Creatomate\Animations\PanCenter([
                                    'start_scale' => '100%',
                                    'end_scale' => '120%',
                                    'easing' => 'linear',
                                ]),
                            ],
                        ]));
                    }

                    if(!$videosCheck && !$narracionCheck){
                        $resultArray->push(new Creatomate\Elements\Audio([
                            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/music1.mp3',
                            // Make the audio track as long as the output
                            'duration' => null,
                            // Fade out for 2 seconds
                            'audio_fade_out' => 2,
                        ]));
                    }
                }
                
                if($narracionCheck){

                    $sumManager = new ResumenHistoriaVida();
                    
                    $urlNarracionPath = $this->generateAudio($sumManager->generarResumen($listaRecuerdos));

                    //$urlNarracionPath = $this->generateAudio("Esto es una narracion de prueba 2.");


                    $urlNarracion = env("APP_URL").str_replace(public_path(), '', $urlNarracionPath); //cambiamos Public por URL
                    
                    $audio = new Mp3Info($urlNarracion); //Objeto para extraer la duración

                    $resultArray->push(new Creatomate\Elements\Audio([
                        'source' => $urlNarracion,
                        // Make the audio track as long as the output
                        'duration' => $audio->duration,
                        // Fade out for 2 seconds
                        'audio_fade_out' => 2,
                    ]));
                }

                if($resultArray->isEmpty()){
                    return "ERROR";
                }else{
                    $source = new Creatomate\Source([
                        'output_format' => 'mp4',
                        'frame_rate' => 30,
                        'width' => 1280,
                        'height' => 720,
                        'elements' => $resultArray->toArray(),
                    ]);
                    
                    $webhook_url =env("APP_URL")."/renderVideo/1";
                    $renders = $client->render(['source' => $source,'webhook_url' => $webhook_url]);
                }

                print_r($renders[0]);
                return $renders[0];
            }
        }

        function generateAudio($text){
            $provider = new VoiceRssProvider(env("VOICERRS_KEY"),"es-es",0);
            $tts = new TextToSpeech($text, $provider);
            $filename = $tts->getFile(public_path()."/storage/audio");
            return $filename;
        }
    }
