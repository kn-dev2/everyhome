<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\HomeSubTypesRepository;
use App\Models\HomeSubType;
use App\Models\HomeType;

class HomeSubTypesClass implements HomeSubTypesRepository
{
    // All home types list
    public function listAll()
    {
        return HomeSubType::with('hometype')->paginate(10);
    }

    // home sub type details
    public function Details($id)
    {
        return HomeSubType::findOrFail($id);
    }

     // home sub type dropdown
     public function DropDown($id,$type='')
     {
         if($type == '')
         {
             return HomeSubType::where(['home_type_id'=>$id,'status'=>1])->get();
         } else {
            return HomeSubType::where(['home_type_id'=>$id,'status'=>1])->pluck('title','id');
         }
     }

    // home type details
    public function getHometype() 
    {
        return HomeType::where('status',1)->pluck('title','id');
    }
}
