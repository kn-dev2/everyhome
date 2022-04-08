<?php
namespace App\Repositories;

Interface HomeSubTypesRepository
{
    public function listAll();

    public function Details($id);

    public function getHometype();

    public function DropDown($id,$type='');

}