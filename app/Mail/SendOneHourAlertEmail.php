<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOneHourAlertEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    protected $data;
    protected $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$email,$type)
    {
        //
        $this->data = $data;
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
        return $this->view('frontend.emails.alert_mail',['data'=>$this->data,'type'=>$this->type]);
    }
}
