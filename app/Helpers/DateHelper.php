<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format berbagai tanggal sesuai dengan status pos.
     *
     * @param  mixed  $createdAt
     * @param  mixed  $updatedAt
     * @param  mixed  $deletedAt
     * @return array
     */
    public static function formatDates($createdAt, $updatedAt, $deletedAt)
    {
        $timezone = 'Asia/Jayapura';
        
        $formattedCreatedAt = $createdAt
            ? Carbon::parse($createdAt)->setTimezone($timezone)->format('Y/m/d \p\u\k\u\l g:i a')
            : 'Tanggal tidak tersedia';

        $formattedUpdatedAt = $updatedAt
            ? Carbon::parse($updatedAt)->setTimezone($timezone)->format('Y/m/d \p\u\k\u\l g:i a')
            : null;

        $formattedDeletedAt = $deletedAt
            ? Carbon::parse($deletedAt)->setTimezone($timezone)->format('Y/m/d \p\u\k\u\l g:i a')
            : 'Tanggal tidak tersedia';

        return [
            'createdAt' => $formattedCreatedAt,
            'updatedAt' => $formattedUpdatedAt,
            'deletedAt' => $formattedDeletedAt,
        ];
    }
}
