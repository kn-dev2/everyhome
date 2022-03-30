<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\CustomerRepository;
use App\User as Customer;

class CustomerClass implements CustomerRepository
{
    // All customers list
    public function listAll($roles)
    {
        return Customer::where('role',$roles['Customer'])->paginate(10);
    }

    // Customer details
    public function customerDetails($id,$roles)
    {
            return Customer::where(['role'=>$roles['Customer'],'id'=>$id])->firstOrFail();
    }
}
