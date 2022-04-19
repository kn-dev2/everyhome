<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBookingRequestEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $bookingRequest;
    protected $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$bookingRequest,$type)
    {
        //
        $this->user = $user;
        $this->type = $type;
        $this->bookingRequest = $bookingRequest;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.emails.booking_request',['user'=>$this->user,'bookingRequest'=>$this->bookingRequest,'type'=>$this->type]);
    }
}
