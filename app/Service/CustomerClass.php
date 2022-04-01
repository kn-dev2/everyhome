<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\CustomerRepository;
use App\Models\User as Customer;

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

    // Customer dropdown
    public function customerDropdown($roles)
    {
            return Customer::where(['role'=>$roles['Customer']])->pluck('name','id');
    }

     // All customers count
     public function countAll($roles)
     {
         return Customer::where('role',$roles['Customer'])->count();
     }
}
