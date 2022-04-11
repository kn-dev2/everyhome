<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSubType extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_type_id', 'title','status','price','hour','min'
    ];

     /**
     * Get the home type that owns the phone.
     */
    public function hometype()
    {
        return $this->hasOne(HomeType::class, 'id','home_type_id');
    }
}
