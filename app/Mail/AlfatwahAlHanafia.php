<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlfatwahAlHanafia extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $subject;
    public $file;

    public function __construct($subject, $body, $file="")
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->file != ""){
            return $this->subject($this->subject)
            // ->attach(url('/'). $this->file) [
            //     'mime' => 'application/pdf',
            // ])
            // ->attach()
            ->view('mails.official');
        }
        return $this->subject($this->subject)
        ->view('mails.official');
    }
}
