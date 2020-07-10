<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait SearchAble
 * @package App\Traits
 */
trait SearchAble
{
    /**
     * @var array
     */
    protected static $model;

    /**
     * @param string $q
     * @return Builder
     */
    public static function search(string $q = "")
    {
        $query = self::query();
        if(empty($q)) {
            return $query;
        }

        if (!isset(self::$model)) {
            self::$model = new static();
        }

        foreach (self::$model->searchable as $field)
        {
            $query->orWhere($field, 'LIKE', "%$q%");
        }

        return $query;
    }
}
