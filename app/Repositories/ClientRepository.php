<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class ClientRepository implements IRepository
{
    protected $client;

    public function __construct(Model $client)
    {
        $this->client = $client;
    }

    public function find(Criteria $criteria)
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }
}
