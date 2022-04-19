<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendBookingRequestEmail;
use App\Models\User;
use Mail;

class SendBookingRequestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $bookingRequest;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$bookingRequest,$type)
    {
        //
        $this->user = $user;
        $this->bookingRequest = $bookingRequest;
        $this->type = $type;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $OrderTemplate = new SendBookingRequestEmail($this->user,$this->bookingRequest ,$this->type);
        Mail::to($this->user->email)->send($OrderTemplate);
    }
}
