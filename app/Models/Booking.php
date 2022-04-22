<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
