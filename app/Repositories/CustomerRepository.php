<?php
namespace App\Repositories;

Interface CustomerRepository
{
    public function listAll($roles);

    public function dropdown();

}