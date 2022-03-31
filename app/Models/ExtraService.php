<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    //
    protected $fillable = [
        'type', 'service_id','title','icon','price','status'
    ];

      /**
     * Get the home type that owns the phone.
     */
    public function hometype()
    {
        return $this->hasOne(HomeType::class, 'id','service_id');
    }

}
