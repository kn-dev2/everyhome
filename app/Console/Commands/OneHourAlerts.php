<?php

namespace App\Console\Commands;

use App\Jobs\SendOneHourAlertEmailJob;
use App\Models\BookingRequest;
use Illuminate\Console\Command;
use Carbon\Carbon;

class OneHourAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'one:hour_alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'one hour alerts sent.';

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
        $BookingRequests = BookingRequest::with('booking_details.customer')->with('booking_details.time_slot')->where('status',2)->distinct()->select('id','booking_id','maid_id')->get();

        $MaidData = array();
        $i=0;
        foreach($BookingRequests as $SingleBookingRequest)
        {
            $TimeSlot                                       = explode('-',$SingleBookingRequest->booking_details->time_slot->slot);
            $MaidData[$i]['customer']                       = $SingleBookingRequest->booking_details->customer;
            $MaidData[$i]['booking_date']                   = $SingleBookingRequest->booking_details->booking_date;
            $MaidData[$i]['time_slot']                      = $SingleBookingRequest->booking_details->time_slot->slot;
            $MaidData[$i]['start_slot_time']                = $TimeSlot[0];
            $MaidData[$i]['start_slot_timestamp']           = Carbon::createFromTimeString($MaidData[$i]['booking_date'].' '.$TimeSlot[0])->timestamp;
            $MaidData[$i]['currentTime']                    = Carbon::now()->format('h:i A');
            $MaidData[$i]['currentTime_timestamp']          = Carbon::now()->timestamp;
            $MaidData[$i]['difference_timestamp']           = $MaidData[$i]['start_slot_timestamp'] - Carbon::now()->timestamp;
            $MaidData[$i]['schedule_id']                    = base64_encode($SingleBookingRequest->id);
            $MaidData[$i]['maid_id']                        = base64_encode($SingleBookingRequest->maid_id);

            if($MaidData[$i]['difference_timestamp']==6000)
            {
                    
                   dispatch_now(new SendOneHourAlertEmailJob($MaidData[$i],$SingleBookingRequest->maid_details->email,'maid'));
            }
            
            
            $i++;
        }
        $this->info('One hour alert sent to maid !');
    }

}
