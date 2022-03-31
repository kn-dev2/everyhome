<?php
namespace App\Repositories;

Interface ExtraServiceRepository
{
    public function listAll();

    public function Details($id);

}