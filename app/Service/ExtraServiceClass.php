<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\ExtraServiceRepository;
use App\Models\ExtraService;

class ExtraServiceClass implements ExtraServiceRepository
{
    // list of all data
    public function listAll()
    {
        return ExtraService::paginate(10);
    }

    // details
    public function Details($id)
    {
        return ExtraService::findOrFail($id);
    }
}
