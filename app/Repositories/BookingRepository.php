<?php
namespace App\Repositories;

Interface BookingRepository
{
    public function listAll($cid);

    public function Details($id,$cid);

}