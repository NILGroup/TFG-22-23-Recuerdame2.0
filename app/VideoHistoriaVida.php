<?php
    namespace App;
    require __DIR__.'/../vendor/autoload.php';

    use Google\Cloud\Video\Transcoder\V1\AudioStream;
use Google\Cloud\Video\Transcoder\V1\EditAtom;
use Google\Cloud\Video\Transcoder\V1\ElementaryStream;
use Google\Cloud\Video\Transcoder\V1\Input;
use Google\Cloud\Video\Transcoder\V1\Job;
use Google\Cloud\Video\Transcoder\V1\JobConfig;
use Google\Cloud\Video\Transcoder\V1\MuxStream;
use Google\Cloud\Video\Transcoder\V1\TranscoderServiceClient;
use Google\Cloud\Video\Transcoder\V1\VideoStream;
use Google\Protobuf\Duration;

    class VideoHistoriaVida{
        private static $location = 'europe-southwest1';
        private static $projectId = 'inspiring-being-381308';
        function generateVideo($array){
            
            $startTimeInput1Sec = (int) floor(abs($startTimeInput1));
            $startTimeInput1Nanos = (int) (1000000000 * bcsub(abs($startTimeInput1), floor(abs($startTimeInput1)), 4));
            $endTimeInput1Sec = (int) floor(abs($endTimeInput1));
            $endTimeInput1Nanos = (int) (1000000000 * bcsub(abs($endTimeInput1), floor(abs($endTimeInput1)), 4));

            $startTimeInput2Sec = (int) floor(abs($startTimeInput2));
            $startTimeInput2Nanos = (int) (1000000000 * bcsub(abs($startTimeInput2), floor(abs($startTimeInput2)), 4));
            $endTimeInput2Sec = (int) floor(abs($endTimeInput2));
            $endTimeInput2Nanos = (int) (1000000000 * bcsub(abs($endTimeInput2), floor(abs($endTimeInput2)), 4));

            $input1Uri= $array[0];
            $input2Uri=$array[1];
            $outputUri="gs://Recuerdame/Output/";

            $startTimeInput1Sec = (int) floor(abs($startTimeInput1));
            $startTimeInput1Nanos = (int) (1000000000 * bcsub(abs($startTimeInput1), floor(abs($startTimeInput1)), 4));
            $endTimeInput1Sec = (int) floor(abs($endTimeInput1));
            $endTimeInput1Nanos = (int) (1000000000 * bcsub(abs($endTimeInput1), floor(abs($endTimeInput1)), 4));
        
            $startTimeInput2Sec = (int) floor(abs($startTimeInput2));
            $startTimeInput2Nanos = (int) (1000000000 * bcsub(abs($startTimeInput2), floor(abs($startTimeInput2)), 4));
            $endTimeInput2Sec = (int) floor(abs($endTimeInput2));
            $endTimeInput2Nanos = (int) (1000000000 * bcsub(abs($endTimeInput2), floor(abs($endTimeInput2)), 4));
        
            // Instantiate a client.
            $transcoderServiceClient = new TranscoderServiceClient();
        
            $formattedParent = $transcoderServiceClient->locationName($projectId, $location);
            $jobConfig =
                (new JobConfig())->setInputs([
                    (new Input())
                        ->setKey('input1')
                        ->setUri($input1Uri),
                    (new Input())
                        ->setKey('input2')
                        ->setUri($input2Uri)
                ])->setEditList([
                    (new EditAtom())
                        ->setKey('atom1')
                        ->setInputs(['input1'])
                        ->setStartTimeOffset(new Duration(['seconds' => $startTimeInput1Sec, 'nanos' => $startTimeInput1Nanos]))
                        ->setEndTimeOffset(new Duration(['seconds' => $endTimeInput1Sec, 'nanos' => $endTimeInput1Nanos])),
                    (new EditAtom())
                        ->setKey('atom2')
                        ->setInputs(['input2'])
                        ->setStartTimeOffset(new Duration(['seconds' => $startTimeInput2Sec, 'nanos' => $startTimeInput2Nanos]))
                        ->setEndTimeOffset(new Duration(['seconds' => $endTimeInput2Sec, 'nanos' => $endTimeInput2Nanos])),
                ])->setElementaryStreams([
                    (new ElementaryStream())
                        ->setKey('video-stream0')
                        ->setVideoStream(
                            (new VideoStream())->setH264(
                                (new VideoStream\H264CodecSettings())
                                    ->setBitrateBps(550000)
                                    ->setFrameRate(60)
                                    ->setHeightPixels(360)
                                    ->setWidthPixels(640)
                            )
                        ),
                    (new ElementaryStream())
                        ->setKey('audio-stream0')
                        ->setAudioStream(
                            (new AudioStream())
                                ->setCodec('aac')
                                ->setBitrateBps(64000)
                        )
                ])->setMuxStreams([
                    (new MuxStream())
                        ->setKey('sd')
                        ->setContainer('mp4')
                        ->setElementaryStreams(['video-stream0', 'audio-stream0'])
                ]);
        
            $job = (new Job())
                ->setOutputUri($outputUri)
                ->setConfig($jobConfig);
        
            $response = $transcoderServiceClient->createJob($formattedParent, $job);
        
            // Print job name.
            printf('Job: %s' . PHP_EOL, $response->getName());
        }


    }
