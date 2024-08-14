<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;




class ExcelController extends Controller
{
    public function showForm()
    {
        return view('excel');
    }
    public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        // Load the uploaded file into PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getRealPath());

        // Assuming you want the data from the first worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Convert the worksheet data into an array
        $sheetData = $worksheet->toArray();
        $userId = Auth::user()->id;

        $output = [
            'user_id' => $userId,
            'data' => $sheetData,
        ];
        // Print the data as a POST array
        echo '<pre>';
        print_r($output);
        echo '</pre>';
        exit;

        return;
    }
}
