<?php
namespace App\Repositories;

Interface ExtraServiceRepository
{
    public function listAll();

    public function get();

    public function Details($id);

}