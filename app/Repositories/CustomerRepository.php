<?php
namespace App\Repositories;

Interface CustomerRepository
{
    public function listAll($roles);

    public function customerDetails($id, $roles);

    public function customerDropdown($roles);

    public function countAll($roles);

}