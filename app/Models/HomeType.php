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
        'title', 'price','status'
    ];

    public function homeSubTypes()
    {
        return $this->belongsTo(HomeSubType::class);
    }

}
