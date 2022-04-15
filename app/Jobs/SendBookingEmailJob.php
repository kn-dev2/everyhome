<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendBookingEmail;
use App\Models\User;
use Mail;

class SendBookingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    protected $userType;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$userType)
    {
        //
        $this->details = $details;
        $this->userType = $userType;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $OrderTemplate = new SendBookingEmail($this->details,$this->userType);
        if($this->userType=='customer')
        {
            Mail::to($this->details->customer->email)->send($OrderTemplate);
        } else if($this->userType=='admin') {
            $Admin = User::where('role',3)->first();
            Mail::to($Admin->email)->send($OrderTemplate);
        }
    }
}
