<?php
namespace App\Repositories;

Interface BookingRepository
{
    public function listAll($cid);

    public function todayAll();

    public function Details($id,$cid);

    public function countAll();

    public function sumAll();


}