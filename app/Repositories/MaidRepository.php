<?php
namespace App\Repositories;

Interface MaidRepository
{
    public function listAll($roles);

    public function maidDetails($id,$roles);

}