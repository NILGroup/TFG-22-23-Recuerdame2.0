<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
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
    public function __construct()
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
        return $this->from('sender@example.com')
                    ->view('vide-mail')
                    ->with(
                      [
                            'url' => 'https://cdn.creatomate.com/renders/932c3e8c-84e9-4527-9a08-f4bd0548f017.mp4',
                            'logo' => asset(public_path('/img').'/Marca_recuerdame-nobg.png')
                      ]) ;
    }
}
