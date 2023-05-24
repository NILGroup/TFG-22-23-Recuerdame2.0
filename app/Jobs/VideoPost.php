<?php

namespace App\Jobs;
require base_path('vendor/autoload.php');
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use duncan3dc\Speaker\TextToSpeech;
use duncan3dc\Speaker\Providers\VoiceRssProvider;
use wapmorgan\Mp3Info\Mp3Info;
use App\Mail\videoMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Video;
use App\Models\User;
use App\ResumenHistoriaVida;
use Illuminate\Support\Facades\File; 
use Creatomate\Client;
use Creatomate;
class VideoPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Video $video, public $videosArray, public $imagesArray, public $imagenesCheck,
    public $videosCheck, public $narracionCheck, public $listaRecuerdos, public $idPaciente ){
    
        //
    }

    /**
     * Execute the job.
     * Crea el vídeo, actualiza la bbdd con su estado y manda un email al usuario de forma asíncrona
     * @return void
     */
    public function handle(){
            $apikey = env("CREATOMATE_KEY");
            $client = new Client($apikey);
            $resultArray = collect();
            if($this->videosCheck){
                foreach ($this->videosArray as $ficheroURL) {
                    $resultArray->push(new Creatomate\Elements\Video([
                        'track' => 2,
                        'source' => $ficheroURL,
                    ]));
                } 
            }

            if($this->imagenesCheck){
                foreach ($this->imagesArray as $ficheroURL) {
                    $resultArray->push(new Creatomate\Elements\Image([
                        'source' => $ficheroURL,
                        "track"=> 2,
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
                if(!$this->videosCheck && !$this->narracionCheck){
                    $resultArray->push(new Creatomate\Elements\Audio([
                        'source' => 'https://creatomate-static.s3.amazonaws.com/demo/music1.mp3',
                        // Make the audio track as long as the output
                        'duration' => null,
                        // Fade out for 2 seconds
                        'audio_fade_out' => 2,
                    ]));
                }
            }

            if($this->narracionCheck){

                $sumManager = new ResumenHistoriaVida();
                
                $urlNarracionPath = $this->generateAudio($sumManager->generarResumen($this->listaRecuerdos));

                $urlNarracion = "http://".env("APP_URL").str_replace(public_path(), '', $urlNarracionPath); //cambiamos Public por URL
                
                $audio = new Mp3Info($urlNarracionPath); //Objeto para extraer la duración
                
                $resultArray->push(new Creatomate\Elements\Image([
                    'source' => "https://drive.google.com/uc?export=view&id=166ss2R9vIu8TAf0T9_BohEQdfNEnpMEN",
                    "track"=> 1,
                    "duration"=> $audio->duration,
                    'animations' => [
                        new Creatomate\Animations\PanCenter([
                            'start_scale' => '100%',
                            'end_scale' => '120%',
                            'easing' => 'linear',
                        ]),
                    ],
                ]));
                $resultArray->push(new Creatomate\Elements\Audio([
                    'source' => $urlNarracion,
                    // Make the audio track as long as the output
                    'duration' => $audio->duration,
                    // Fade out for 2 seconds
                    'audio_fade_out' => 2,
                ]));
            }

            if($resultArray->isEmpty()){
                //error
                Log::error("Se ha intentado crear un vídeo sin recuerdos ni multimedia");
            }else{
                $source = new Creatomate\Source([
                    'output_format' => 'mp4',
                    'frame_rate' => 30,
                    'width' => 1280,
                    'height' => 720,
                    'elements' => $resultArray->toArray(),
                ]);
                
                //Renderizamos de forma síncrona
                $renders = $client->render(['source' => $source]);
                //Video Generado, actualizamos y notificamos
                $this->video->estado = $renders[0]['status']=="succeeded"?"Completado":"Error";
                $this->video->crea_id = $renders[0]['id'];
                $this->video->url = $renders[0]['url'];
                $this->video->save();



                $usuario = User::find($this->idPaciente);
                Mail::to($usuario->email)->send(new VideoMail($this->video));
                //Borramos caché vídeos
                if($this->narracionCheck){
                    if(File::exists($urlNarracionPath)){
                        File::delete($urlNarracionPath);
                    }
                }
            }
        }

        function generateAudio($text){
            $provider = new VoiceRssProvider(env("VOICERRS_KEY"),"es-es",0);
            $tts = new TextToSpeech($text, $provider);
            $filename = $tts->getFile(public_path()."/storage/audio");
            return $filename;
        }

}
