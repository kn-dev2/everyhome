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
    // All home types list
    public function listAll()
    {
        return HomeType::paginate(10);
    }

    // home type details
    public function Details($id)
    {
            return HomeType::findOrFail($id);
    }
}
