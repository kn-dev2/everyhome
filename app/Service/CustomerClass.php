<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\CustomerRepository;
use App\User as Customer;
use Auth;

class CustomerClass implements CustomerRepository
{
    public function listAll()
    {
        return Customer::where('role',1)->paginate(10);
    }

    public function dropdown()
    {
        return Customer::where('id', Auth::User()->id)->pluck('name','id');
    }
}
