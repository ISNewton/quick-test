<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

        $rows = Excel::toArray([],  $request->excel);

        $headings = $rows[0][0];

        $excel = $request->excel;

        session()->put('excel', $request->file('excel')->store('excel'));


        return view('ensure-import-columns', compact('headings', 'excel'));
    }


    public function import(Request $request)
    {

        Excel::import(new ProductImport($request->products, $request->type, $request->qty),  session()->get('excel'));

        Storage::delete(session()->get('excel'));

        return redirect(route('home'))->with('message', 'Products imported successfully');
    }

    public function approve(User $user)
    {
        $user->update([
            'status' => User::STATUS_APPROVED
        ]);

        return back()->with('message', 'Account approved successfully');
    }
}
