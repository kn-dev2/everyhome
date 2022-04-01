<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    //

    public function extra_service()
    {
        return $this->hasOne(ExtraService::class, 'id','extra_service_id');
    }
}
