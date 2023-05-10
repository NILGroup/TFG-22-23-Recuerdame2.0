<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Video;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class videoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Video $video)
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '¡Hay novedades sobre su vídeo!',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.video-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    /** 
* Build the message. 
* 
* @return $this 
*/
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('vide-mail')
                    ->with(
                        [
                            'titulo' => $this->video->nombre,
                            'url' => $this->video->url,
                            'logo' => "http://".env('APP_URL').'/img/Marca_recuerdame-nobg.png',
                        ]) ;
    }
}
