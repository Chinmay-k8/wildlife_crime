<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
         $formData = Form::with(['accused', 'arrestedAccused', 'circle', 'division', 'range', 'section', 'beat', 'forestblock'])->get();

         // Return the data as JSON
        return response()->json($formData);
    }
}
 