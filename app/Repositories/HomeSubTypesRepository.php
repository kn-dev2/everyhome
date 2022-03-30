<?php
namespace App\Repositories;

Interface HomeSubTypesRepository
{
    public function listAll();

    public function Details($id);

    public function getHometype();

}