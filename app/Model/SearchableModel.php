<?php


namespace App\Model;


use App\Traits\SearchAble;
use Illuminate\Database\Eloquent\Model;

abstract class SearchableModel extends Model
{
    use SearchAble;

}
