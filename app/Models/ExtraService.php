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
    public function service()
    {
        return $this->hasOne(Service::class, 'id','service_id');
    }

}
