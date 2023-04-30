<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Models\User;

class ExcelController extends Controller
{
    public function index()
    {
        $users = User::where('status', '!=', user::STATUS_APPROVED)->get();
        return view('welcome', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new ProductImport,  $request->excel);

        return back()->with('message', 'Products imported successfully');
    }

    public function approve(User $user)
    {
        $user->update([
            'status' => User::STATUS_APPROVED
        ]);

        return back()->with('message', 'Account approved successfully');
    }
}
