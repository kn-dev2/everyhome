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

    // home type details
    public function Details($id)
    {
        return HomeSubType::findOrFail($id);
    }

    // home type details
    public function getHometype() 
    {
        return HomeType::where('status',1)->pluck('title','id');
    }
}
