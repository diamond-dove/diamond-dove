<?php

namespace App\Model;

use App\User;

class Loan extends SearchableModel
{
    //
    protected $fillable = [
        'amount',
        'rate',
        'frequency',
        'fee',
    ];

    protected $searchable = [];

    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const BIWEEKLY = 'biweekly';
    const MONTHLY = 'monthly';

    public static $frequencies = [self::DAILY, self::WEEKLY, self::BIWEEKLY, self::MONTHLY];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
