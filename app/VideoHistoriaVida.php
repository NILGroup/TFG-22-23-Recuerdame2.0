<?php
    namespace App;
    require __DIR__.'/../vendor/autoload.php';

    use Creatomate\Client;
    use Creatomate;

use function PHPUnit\Framework\isNull;

    class VideoHistoriaVida{

        function generateVideo($videosArray, $imagesArray){
            $apikey = env("CREATOMATE_KEY");
            if($apikey.isNull()){
                return null;
            }else{
                $client = new Client($apikey);
                $resultArray = collect();
                foreach ($videosArray as $ficheroURL) {
                        $resultArray->push(new Creatomate\Elements\Video([
                            'track' => 1,
                            'source' => $ficheroURL,
                        ]));
                } 
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
                $source = new Creatomate\Source([
                    'output_format' => 'mp4',
                    'width' => 1280,
                    'height' => 720,
                    'elements' => $resultArray->toArray(),
                ]);

                $renders = $client->render(['source' => $source]);
                //print_r($renders[0]['url']);
                return $renders[0]['url'];
            }
        }


    }
