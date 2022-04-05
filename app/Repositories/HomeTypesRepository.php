<?php
namespace App\Repositories;

Interface HomeTypesRepository
{
    public function listAll();

    public function dropdown();

    public function Details($id);

}