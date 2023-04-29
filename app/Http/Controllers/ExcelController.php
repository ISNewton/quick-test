<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ExcelController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel' => 'file'
        ]);


        Excel::import(new ProductImport ,  $request->excel->store('temp'));

        return back()->with('message' , 'Products imported successfully');
    }
}
