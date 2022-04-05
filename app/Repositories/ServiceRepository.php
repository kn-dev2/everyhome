<?php
namespace App\Repositories;

Interface ServiceRepository
{
    public function listAll();

    public function dropdown();

    public function serviceDetails($id);

}