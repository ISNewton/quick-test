<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{

    protected $products;
    protected $type;
    protected $qty;

    function __construct($products, $type, $qty)
    {
        $this->products = $products;
        $this->type = $type;
        $this->qty = $qty;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[$this->products],
            'type' => $row[$this->type],
            'qty' => $row[$this->qty]
        ]);
    }
}
