<?php
    namespace App;
    require __DIR__.'/../vendor/autoload.php';

    use Creatomate\Client;
    use Creatomate;
    use duncan3dc\Speaker\TextToSpeech;
    use duncan3dc\Speaker\Providers\VoiceRssProvider;

    class VideoHistoriaVida{

        function generateVideo($videosArray, $imagesArray, $imagenesCheck, $videosCheck, $narracionCheck){
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
    
                    $renders = $client->render(['source' => $source]);
                }

                //print_r($renders[0]['url']);
                return $renders[0]['url'];
            }
        }

        function generateAudio($text){
            $provider = new VoiceRssProvider(env("VOICERRS_KEY"),"es-es",1);
            $tts = new TextToSpeech($text, $provider);
            $filename = $tts->getFile(public_path()."/storage/audio");
            //print_r(var_dump($filename));
            return $filename;
        }
    }
