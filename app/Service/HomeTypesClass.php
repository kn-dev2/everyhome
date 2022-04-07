<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\HomeTypesRepository;
use App\Models\HomeType;

class HomeTypesClass implements HomeTypesRepository
{
    // first home type
    public function first($sid=null)
    {
        if($sid!=null)
        {
            return HomeType::where('service_id',$sid)->first();
        } else {
            return HomeType::first();
        }
    }

    // All home types list
    public function listAll()
    {
        return HomeType::with('service')->paginate(10);
    }

     // All home types dropdown
     public function dropdown($sid=null)
     {
        if($sid==null)
        {
            return HomeType::where('status',1)->pluck('title','id');
        } else {
            return HomeType::where('status',1)->where('service_id',$sid)->pluck('title','id');
        }
     }

    // home type details
    public function Details($id)
    {
            return HomeType::findOrFail($id);
    }

}
