<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class MaidTimeSlot extends Model
{
    //


    public static function CheckExistingTimeSlot($date,$timeslot,$id=null)
    {
        if(!$id)
        {
            $Count = MaidTimeSlot::where(['date'=>$date,'time_slot_id'=>$timeslot,'maid_id'=>Auth::User()->id])->count();
        } else {
            $Count = MaidTimeSlot::where(['date'=>$date,'time_slot_id'=>$timeslot,'maid_id'=>Auth::User()->id])->where('id','<>',$id)->count();
        }

        return $Count;
    }
    public function timeSlot()
    {
        return $this->hasOne(TimeSlot::class,'id','time_slot_id');
    }

    public function bookingRequests()
    {
        return $this->hasOne(BookingRequest::class,'maid_time_slot_id','id');
    }
}
