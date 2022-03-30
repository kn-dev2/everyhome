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
    // list of all maids
    public function listAll($roles)
    {
        return Maid::where('role',$roles['Maid'])->paginate(10);
    }

    // Maid details
    public function maidDetails($id,$roles)
    {
        return Maid::where(['role'=>$roles['Maid'],'id'=>$id])->firstOrFail();
    }
}
