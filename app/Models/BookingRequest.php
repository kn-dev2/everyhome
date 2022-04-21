<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    //

    protected $fillable = [
        'booking_id', 'maid_id','maid_time_slot_id','arrive_date','arrive_time','special_instructions','status'
    ];

    public function maid_time_slot()
    {
        return $this->hasOne(MaidTimeSlot::class, 'id','maid_time_slot_id');
    }

    public function booking_details()
    {
        return $this->hasOne(Booking::class, 'id','booking_id');
    }

    public function calculateTotalTime($booking_details)
    {
        if(isset($booking_details->home_sub_type->min))
        {
            $Totalminutes = (int)$booking_details->home_type->min + (int)$booking_details->home_sub_type->min;
        } else {
            $Totalminutes = (int)$booking_details->home_type->min;
        }

        $hours = floor($Totalminutes / 60).' hours '.($Totalminutes -   floor($Totalminutes / 60) * 60).' minutes';

        return $hours;
    }
}
