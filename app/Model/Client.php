<?php

namespace App\Model;

use App\Traits\SearchAble;

class Client extends SearchableModel
{
    //
    protected $fillable = [
      'first_name',
      'last_name',
      'identifier',
      'cell_phone',
      'phone',
      'address',
      'note',
    ];

    protected $searchable = [
        'first_name',
        'last_name',
        'identifier',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'sector', 'debt'];

    /**
     * Get the client's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the client's full name.
     *
     * @return string
     */
    public function getSectorAttribute()
    {
        return "sector";
    }

    /**
     * Get the client's full name.
     *
     * @return string
     */
    public function getDebtAttribute()
    {
        return "$0.00";
    }
}
