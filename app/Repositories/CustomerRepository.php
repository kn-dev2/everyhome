<?php
namespace App\Repositories;

Interface CustomerRepository
{
    public function listAll($roles);

    public function customerDetails($id, $roles);

}