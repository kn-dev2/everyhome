<?php
namespace App\Repositories;

Interface ServiceRepository
{
    public function listAll();

    public function serviceDetails($id);

}