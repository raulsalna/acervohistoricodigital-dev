<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    private $url;
    private $type;

    public function __construct($url,$type)
    {
      $this->url = $url;
      $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      if ($this->type == 1) $subject = 'Nuevo';
      else $subject = 'Nuevo ';

      return $this->subject($subject)
        ->view('email.mail')
        ->with(['url' => $this->url, 'type'=>$this->type]);
    }
}
