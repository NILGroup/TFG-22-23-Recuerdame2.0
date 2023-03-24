<?php
    namespace App;
    require __DIR__.'/../vendor/autoload.php';

    use Creatomate\Client;
    use Creatomate;

    class VideoHistoriaVida{

        function generateVideo($videosArray, $imagesArray){
            $client = new Client('2929242c49d5422dbf642461869bfcc60dab1cee9ffdd795a88b6cd8e6ea6e797b2adeaf73ce472dab9c93a3a6ad7e95');
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
            //return response()->json($renders, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }


    }
