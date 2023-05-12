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
     *
     * @return void
     */
    public function handle(){
            $apikey = env("CREATOMATE_KEY");
            $client = new Client($apikey);
            $resultArray = collect();
            if($this->videosCheck){
                foreach ($this->videosArray as $ficheroURL) {
                    $resultArray->push(new Creatomate\Elements\Video([
                        'track' => 1,
                        'source' => $ficheroURL,
                    ]));
                } 
            }

            if($this->imagenesCheck){
                foreach ($this->imagesArray as $ficheroURL) {
                    $resultArray->push(new Creatomate\Elements\Image([
                        'source' => $ficheroURL,
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
                
                $webhook_url ="http://".env("APP_URL")."/renderVideo";
                $renders = $client->render(['source' => $source,'webhook_url' => $webhook_url]);
                //Video Generado, actualizamos y notificamos
                $this->video->estado = $renders[0]['status']=="succeeded"?"Completado":"Error";
                $this->video->crea_id = $renders[0]['id'];
                $this->video->url = $renders[0]['url'];
                $this->video->save();

                $usuario = User::find($this->idPaciente);
                Mail::to($usuario->email)->send(new VideoMail($this->video));
                if(File::exists($urlNarracionPath)){
                    File::delete($urlNarracionPath);
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
