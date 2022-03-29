<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\MaidRepository;
use App\User as Maid;

class MaidClass implements MaidRepository
{
    public function listAll($roles)
    {
        return Maid::where('role',$roles['Maid'])->paginate(10);
    }

    public function dropdown()
    {
        return Maid::where('id', 2)->pluck('name','id');
    }
}
