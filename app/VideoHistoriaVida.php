<?php
    namespace App;
    require __DIR__.'/../vendor/autoload.php';

    use JSON2Video\Movie;
    use JSON2Video\Scene;
use PhpParser\Node\Stmt\Return_;

    class VideoHistoriaVida{

        function generateVideo($array){

            // Create a new movie
            $movie = new Movie;

            // Set your API key
            $movie->setAPIKey("tke9aeKOYB7tZI1f6JuvC7LrjpsKg0Xw9IHj1TJ1");

            // Set movie quality: low, medium, high
            $movie->resolution = 'full-hd';
            $movie->quality = 'high';
            $movie->draft = true;

            // // Create a new scene
            $i = 1;
            foreach ($array as $ficheroURL) {

                $scene = new Scene;
                $scene ->comment = 'Escena #'.$i;
                $scene ->addElement([
                    'type' => 'video',
                    'src' => $ficheroURL
                ]);
                $movie->addScene($scene);
                $i++;
            }


            // Add the scene to the movie


            // // Call the API and start rendering the movie
            $result = $movie->render();

            // Wait for the render to finish
            $movie->waitToFinish(10);

            if(!empty($result['url'])){
                return $result['url'];
            }else{
                $movie->waitToFinish(20);
                if(!empty($result['url'])){
                    return $result['url'];
                }else{
                    return "Error";
                }
            }



        }


    }
