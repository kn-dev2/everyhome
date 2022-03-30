<?php
namespace App\Repositories;

Interface HomeTypesRepository
{
    public function listAll();

    public function Details($id);

}