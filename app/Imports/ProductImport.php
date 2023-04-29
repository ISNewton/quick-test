<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow , SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $products_column = $row['products'] ?? $this->getUnknownColumnValue($row,0);
        $type_column = $row['type'] ?? $this->getUnknownColumnValue($row,1);
        $qty_column = $row['qty'] ?? $this->getUnknownColumnValue($row,2);


        return new Product([
            'name' => $products_column,
            'type' => $type_column,
            'qty' => $qty_column
        ]);

    }

    protected function getUnknownColumnValue($row, $needed_column_index)
    {
        $filtered_row = array_filter($row, function ($value, $key) {
            return !in_array($key, ['products', 'type', 'qty']);
        }, ARRAY_FILTER_USE_BOTH);

        return array_values(array_slice($filtered_row,$needed_column_index , 1))[0] ?? null ;
    }
}
