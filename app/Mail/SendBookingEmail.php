<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBookingEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $orderDetails;
    protected $userType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails,$userType)
    {
        //
        $this->orderDetails = $orderDetails;
        $this->userType = $userType;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.emails.order_confirmation',['order'=>$this->orderDetails,'user_type'=>$this->userType]);
    }
}
