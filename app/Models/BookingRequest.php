<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    //

    protected $fillable = [
        'booking_id', 'maid_id','maid_time_slot_id','arrive_date','arrive_time','status'
    ];

    public function maid_time_slot()
    {
        return $this->hasOne(MaidTimeSlot::class, 'id','maid_time_slot_id');
    }

    public function booking_details()
    {
        return $this->hasOne(Booking::class, 'id','booking_id');
    }
}
