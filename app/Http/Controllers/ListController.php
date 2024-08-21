<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Accused;
use App\Models\ArrestedAccused;

class ListController extends Controller
{
    public function showList()
    {

         // Fetch all form data with related accused and arrested accused records
        $formData = Form::with(['accused', 'arrestedAccused'])->get();

        // Pass the data to the view
        return view('list', ['formData' => $formData]);
    }
}
 