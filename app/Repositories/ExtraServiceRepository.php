<?php
namespace App\Repositories;

Interface ExtraServiceRepository
{
    public function listAll();

    public function get($sid=null);

    public function Details($id);

    public function DetailsbyserviceId($sid);


}