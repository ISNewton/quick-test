<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function store(Request $request) {
        $request->validate([
            'file' => 'file|mimes:xlsx'
        ]);
        
        dd(3434);
    }
}
