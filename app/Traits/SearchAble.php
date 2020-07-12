<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Helpers\Searchable as helper;

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
     * @param string $term
     * @return Builder
     */
    public static function search(string $term = "")
    {
        $query = self::query();
        if(empty($q)) {
            return $query;
        }

        return helper::search(self::getModel()->searchable, $query, $term);
    }

    public static function getModel()
    {
        if (!isset(self::$model)) {
            self::$model = new self();
        }

        return self::$model;
    }

    public static function getSearchableFields()
    {
        return self::getModel()->searchable;
    }
}
