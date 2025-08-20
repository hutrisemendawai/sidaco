<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FishingDataImport;

class FishingDataImportController extends Controller
{
    public function importForm()
    {
        return view('sidat.import');
    }

    public function import()
    {
        $path = 'E:\filipin.csv'; // lokasi file CSV
        Excel::import(new FishingDataImport, $path);

        return response()->json(['message' => 'Import selesai dari ' . $path]);
    }

    // versi upload manual (optional)
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
        //Excel::queueImport(new FishingDataImport, $request->file('file'));
        Excel::import(new FishingDataImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimport');
    }
}