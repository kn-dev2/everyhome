<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\ServiceRepository;
use App\Service;

class ServiceClass implements ServiceRepository
{
    // list of all maids
    public function listAll()
    {
        return Service::paginate(10);
    }

    // Maid details
    public function serviceDetails($id)
    {
        return Service::findOrFail($id);
    }
}
