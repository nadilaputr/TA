<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateFormat
{
    static function from($date)
    {
        return Carbon::parse($date)->isoFormat('DD MMMM YYYY');
    }
}