<?php


namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class Searchable
{
    public static function search(array $fields,Builder $query,string $term): Builder
    {
        foreach ($fields as $field)
        {
            $query->orWhere($field, 'LIKE', "%$term%");
        }

        return $query;
    }
}
