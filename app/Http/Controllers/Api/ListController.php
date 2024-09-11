<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Form;
use App\Models\Accused;
use App\Models\ArrestedAccused;

class ListController extends Controller
{
    public function showList()
    {

        // Pass the data to the view
        return view('list');
    }
    public function fetchData()
    {
         // Fetch all form data with related accused and arrested accused records
         $formData = Form::with(['accused', 'arrestedAccused', 'circle', 'division', 'range', 'section', 'beat',  'nbwAccused', 'releasedAccused', 'accusedMobiles', 'uploads'])->get();

         // Return the data as JSON
        return response()->json($formData);
    }
    public function downloadDocument($fileType, $fileName)
    {
        // Build the file path based on the file type (e.g., post-mortem report, electrical inspector report, etc.)
        $filePath = 'uploads/' . $fileType . '/' . $fileName;
    
        // Check if the file exists in the storage
        if (Storage::disk('public')->exists($filePath)) {
            // Return the file as a response to download
            return Storage::disk('public')->download($filePath);
        }
    
        // If the file does not exist, return a 404 error
        abort(404, 'File not found.');
    }
}
 