<?php
namespace App\Repositories;

Interface HomeTypesRepository
{
    public function first($sid);

    public function listAll();

    public function dropdown($sid=null);

    public function Details($id);

}