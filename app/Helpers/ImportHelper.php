<?php

namespace App\Helpers;

class ImportHelper
{
    public static function getFilteredArray($row)
    {
        $filtered_row = array_filter($row, function ($value, $key) {
            return !in_array($key, ['products', 'type', 'qty']);
        }, ARRAY_FILTER_USE_BOTH);

        return $filtered_row;
    }

    public static function isUnknownHeadingShouldBeSelected($headings ,$needed_column_index  , $row_name) {
        $filtered_headings = self::getFilteredArray($headings);


        return $filtered_headings[$needed_column_index] == $row_name ? 'selected' : '';

    }
}
