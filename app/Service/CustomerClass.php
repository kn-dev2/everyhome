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
    public function listAll($roles)
    {
        return Customer::where('role',$roles['Customer'])->paginate(10);
    }

    public function dropdown()
    {
        return Customer::where('role', 2)->pluck('name','id');
    }
}
