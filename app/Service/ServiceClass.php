<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\ServiceRepository;
use App\Models\Service;

class ServiceClass implements ServiceRepository
{
    // list of all Services
    public function listAll($status=null)
    {
        if($status==null)
        {
            return Service::paginate(10);

        } else {
            return Service::where('status',$status)->paginate(10);
        }
    }

    // dropdown of all Services
    public function dropdown()
    {
        return Service::where('status',1)->pluck('title','id');
    }

    // Service details
    public function serviceDetails($id)
    {
        return Service::findOrFail($id);
    }
}
