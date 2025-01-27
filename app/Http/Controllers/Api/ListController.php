<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Form;
use App\Models\Accused;
use App\Models\ArrestedAccused;
use App\Models\MasterSpecies;



class ListController extends Controller
{
    public function showList()
    {

        // Pass the data to the view
        return view('list');
    }
    public function fetchData(Request $request)
    {
        // Get the designation id from the authenticated user
        $designationId = auth()->user()->designation_id;

        // Initialize the query
        $query = Form::with(['arrestedAccused', 'circle', 'division', 'range', 'section', 'beat',  'nbwAccused', 'releasedAccused', 'accusedMobiles', 'abscondedAccused', 'additionalpr', 'uploads', 'species']);

        // Apply conditions based on the designation id
        if ($designationId == 4) {
            $query->whereIn('current_status', ['acf_approved', 'dfo_approved']);
        } elseif ($designationId == 3) {
            $query->where('current_status', 'dfo_approved');
        }

        // Fetch the data in ascending order of id
        $formData = $query->orderBy('id', 'asc')->get();

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
 