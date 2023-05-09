<?php

namespace App\Jobs;
require __DIR__.'/../vendor/autoload.php';
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
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
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $apikey = env("CREATOMATE_KEY");
        $client = new Client($apikey);
        $resultArray = collect();

                        $resultArray->push(new Creatomate\Elements\Audio([
                            'source' => 'https://creatomate-static.s3.amazonaws.com/demo/music1.mp3',
                            // Make the audio track as long as the output
                            'duration' => 1,
                            // Fade out for 2 seconds
                            'audio_fade_out' => 2,
                        ]));

        $source = new Creatomate\Source([
            'output_format' => 'mp4',
            'frame_rate' => 30,
            'width' => 1280,
            'height' => 720,
            'elements' => $resultArray->toArray(),
        ]);
        $client->render(['source' => $source,'webhook_url' => "test"]);
    }
}
