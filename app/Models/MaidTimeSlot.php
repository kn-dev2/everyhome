<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaidTimeSlot extends Model
{
    //

    public function timeSlot()
    {
        return $this->hasOne(TimeSlot::class,'id','time_slot_id');
    }
}
