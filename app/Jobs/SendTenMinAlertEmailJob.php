<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendTenMinAlertEmail;
use Mail;

class SendTenMinAlertEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    protected $type;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $AlertTemplate = new SendTenMinAlertEmail($this->email,$this->type);

        Mail::to($this->email)->send($AlertTemplate);
       
    }
}
