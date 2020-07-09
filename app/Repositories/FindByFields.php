<?php


namespace App\Repositories\Client;


use App\Repositories\Criteria;

class FindByFields implements Criteria
{

    public function __construct($field)
    {
    }

    public function toString(): string
    {
        // TODO: Implement toString() method.
    }
}
