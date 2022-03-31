<?php
namespace App\Repositories;

Interface DiscountCodesRepository
{
    public function listAll();

    public function Details($id);

}