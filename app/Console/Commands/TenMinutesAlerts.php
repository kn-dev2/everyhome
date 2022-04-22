<?php

namespace App\Console\Commands;

use App\Jobs\SendTenMinAlertEmailJob;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\BookingRequest;

class TenMinutesAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ten:minutes_alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ten minutes alerts sent.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Today = Carbon::parse()->format('Y-m-d');

        $BookingRequests = BookingRequest::with('booking_details.customer')->with('booking_details.time_slot')->where('status',1)->distinct()->select('booking_id')->get();

        $CustomerData = array();
        $i=0;
        foreach($BookingRequests as $SingleBookingRequest)
        {
            $TimeSlot                                           = explode('-',$SingleBookingRequest->booking_details->time_slot->slot);
            $CustomerData[$i]['customer_name']                  = $SingleBookingRequest->booking_details->customer->name;
            $CustomerData[$i]['customer_email']                 = $SingleBookingRequest->booking_details->customer->email;
            $CustomerData[$i]['booking_date']                   = $SingleBookingRequest->booking_details->booking_date;
            $CustomerData[$i]['time_slot']                      = $SingleBookingRequest->booking_details->time_slot->slot;
            $CustomerData[$i]['start_slot_time']                = $TimeSlot[0];
            $CustomerData[$i]['start_slot_timestamp']           = Carbon::createFromTimeString($CustomerData[$i]['booking_date'].' '.$TimeSlot[0])->timestamp;
            $CustomerData[$i]['currentTime']                    = Carbon::now()->format('h:i A');
            $CustomerData[$i]['currentTime_timestamp']          = Carbon::now()->timestamp;
            $CustomerData[$i]['difference_timestamp']           = $CustomerData[$i]['start_slot_timestamp'] - Carbon::now()->timestamp;

            if($CustomerData[$i]['difference_timestamp']==600)
            {
                dispatch(new SendTenMinAlertEmailJob($CustomerData));
            }
            
            $i++;
        }

        $this->info('Ten minutes alert sent to client !');
    }

}
