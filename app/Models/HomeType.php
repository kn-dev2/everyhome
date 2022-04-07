<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id','title', 'price','hour','min','status'
    ];

    public function service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function homeSubTypes()
    {
        return $this->belongsTo(HomeSubType::class);
    }

}
