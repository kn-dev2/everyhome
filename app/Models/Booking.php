<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'booking_date', 'time_slot_id','booking_id','services_id','home_type_id','home_sub_type_id','customer_id','discout_coupan_id','discout_price','total_price','total_hours','schedule_type','full_response','status'
    ];
     
    public function service()
    {
        return $this->hasOne(Service::class, 'id','services_id');
    }

    public function time_slot()
    {
        return $this->hasOne(TimeSlot::class, 'id','time_slot_id');
    }

    public function home_type()
    {
        return $this->hasOne(HomeType::class, 'id','home_type_id');
    }

    public function home_sub_type()
    {
        return $this->hasOne(HomeSubType::class, 'id','home_sub_type_id');
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class, 'booking_id','id');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id','customer_id');
    }

    public function acceptRequests() {
        return $this->hasOne(BookingRequest::class, 'booking_id','id')->WhereIn('status', [2,4,5,6,7]);
    }

    public function notacceptRequests() {
        return $this->hasOne(BookingRequest::class, 'booking_id','id')->Where('status', 1);
    }

    public function AlreadyRequests($bid) {
        return BookingRequest::where(['maid_id'=>\Auth::User()->id,'booking_id'=>$bid])->count();
    }

    public function NotacceptedByOther($id)
    {
        $BookingRequests = BookingRequest::with('booking_details.customer')->with('booking_details.time_slot')->where('booking_id',$id)->where('status','<>',2)->distinct()->select('booking_id')->first();

        // if(isset($BookingRequests->booking_details))
        // {

            $TimeSlot        = explode('-',$BookingRequests->booking_details->time_slot->slot);

            $start_slot_timestamp           = Carbon::createFromTimeString($BookingRequests->booking_date.' '.$TimeSlot[0])->timestamp;
            $currentTime                    = Carbon::now()->format('h:i A');
            $currentTime_timestamp          = Carbon::now()->timestamp;
            $difference_timestamp           = $start_slot_timestamp - $currentTime_timestamp;

            return $difference_timestamp;
        // } else {

        //     return 1000;
        // }


        // $CustomerData = array();
        // $i=0;
        // foreach($BookingRequests as $SingleBookingRequest)
        // {
        //     $TimeSlot                                           = explode('-',$SingleBookingRequest->booking_details->time_slot->slot);
        //     $CustomerData[$i]['customer_name']                  = $SingleBookingRequest->booking_details->customer->name;
        //     $CustomerData[$i]['customer_email']                 = $SingleBookingRequest->booking_details->customer->email;
        //     $CustomerData[$i]['booking_date']                   = $SingleBookingRequest->booking_details->booking_date;
        //     $CustomerData[$i]['time_slot']                      = $SingleBookingRequest->booking_details->time_slot->slot;
        //     $CustomerData[$i]['start_slot_time']                = $TimeSlot[0];
        //     $CustomerData[$i]['start_slot_timestamp']           = Carbon::createFromTimeString($CustomerData[$i]['booking_date'].' '.$TimeSlot[0])->timestamp;
        //     $CustomerData[$i]['currentTime']                    = Carbon::now()->format('h:i A');
        //     $CustomerData[$i]['currentTime_timestamp']          = Carbon::now()->timestamp;
        //     $CustomerData[$i]['difference_timestamp']           = $CustomerData[$i]['start_slot_timestamp'] - Carbon::now()->timestamp;

        //     if($CustomerData[$i]['difference_timestamp']==600)
        //     {
        //         dispatch(new SendTenMinAlertEmailJob($CustomerData));
        //     }
            
        //     $i++;
        // }
    }

}
