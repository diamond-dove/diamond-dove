<?php


namespace App\Traits;


trait SearchAble
{
    public static function search(string $q = "")
    {
        $query = self::query();
        if(empty($q)) {
            return $query;
        }

        $fields = self::$seacher_fields;
        foreach ($fields as $field)
        {
            $query->orWhere($field, 'LIKE', "%$q%");
        }

        return $query;
    }

}
