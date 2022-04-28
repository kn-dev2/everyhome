<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = [
        'customer_id','discount_code', 'amount','vaild_from','valid_till','type','no_of_usage_customer','min_spend'
    ];


    public function customer()
    {
        return $this->hasOne(User::class, 'id','customer_id');
    }
}
