<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }
    // Handle form submission
    public function submitForm(Request $request)
    {
        // Validate the request data
        $request->validate([
            'circle' => 'required|string',
            'division' => 'nullable|string',
            'range' => 'nullable|string',
            'section' => 'nullable|string',
            'beat' => 'nullable|string',
            'case_no' => 'nullable|string',
            'case_type' => 'nullable|string',
        ]);

        // Process the form data
        $formData = $request->all();
         echo '<pre>';
        print_r($formData);
        echo '</pre>';
        exit;

        // Redirect back with a success message
        // return redirect()->back()->with('success', 'Data submitted successfully!');
    }
}
