<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HrisImport;

class ImportExcelController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new HrisImport, $request->file('file'));

        return redirect()
            ->route('import.index')
            ->with('success', 'Data Excel berhasil diimport ke database.');
    }
}