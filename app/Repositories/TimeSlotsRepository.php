<?php
namespace App\Repositories;

Interface TimeSlotsRepository
{
    public function listAll();

    public function maidTimeSlots($date);

    public function Details($id);

    public function getAllTimeSlot();

}