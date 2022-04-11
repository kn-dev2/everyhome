<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    //
    protected $fillable = [
        'booking_id', 'extra_service_id','qty','base_price','price'
    ];

    public function extra_service()
    {
        return $this->hasOne(ExtraService::class, 'id','extra_service_id');
    }
}
