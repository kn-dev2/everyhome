<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTenMinAlertEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    protected $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$type)
    {
        //
        $this->email = $email;
        $this->type = $type;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.emails.alert_mail',['data'=>'','type'=>$this->type]);
    }
}
