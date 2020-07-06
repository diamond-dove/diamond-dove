<?php


namespace App\Repositories;


interface IRepository
{
    public function find(Criteria $criteria);

    public function create();

    public function update();
}
