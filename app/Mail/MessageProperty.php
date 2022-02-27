<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageProperty extends Mailable
{
    use Queueable, SerializesModels;
    public $data = [];
    public $nameprop;
    public $titleprop;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$nameprop,$titleprop)
    {
        $this->data = $data;
        $this->nameprop = $nameprop;
        $this->titleprop = $titleprop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.message.property',['data'=>$this->data,'name'=>$this->nameprop,'titleprop'=>$this->titleprop]);
    }
}
