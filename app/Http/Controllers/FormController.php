<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form; 
use App\Models\Accused; 
use App\Models\ArrestedAccused;
use App\Models\AccusedMobiles;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');    
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        // Fetch all form data excluding nested arrays for accused and arrested accused
        $formData = $request->except(['accused', 'arrested_accused', 'accused_mobile']);
        $accusedData = $request->input('accused');
        $arrestedAccusedData = $request->input('arrested_accused');
        $MobileData = $request->input('accused_mobile');

        $formData['user_id'] = Auth::id(); // Include user_id from Auth
        
        // Save form data to the database
        $form = new Form();
        $formId = $form->saveFormData($formData); // Assuming this method exists in Form model
        

        // Debug: Make sure form ID is saved and fetched correctly
        if (!$formId) {
            return redirect()->back()->withErrors('Failed to save form data.');
        }

        // Save accused details
        if (!empty($accusedData)) {
            foreach ($accusedData as $accusedItem) {
                // Create and save each accused record
                $accusedItem['form_data_id'] = $formId; // Add form_data_id to each accused item
                Accused::create($accusedItem); // Use the create method for mass assignment
            }
        }

        // Save arrested accused details
        if (!empty($arrestedAccusedData)) {
            foreach ($arrestedAccusedData as $arrestedItem) {
                // Create and save each arrested accused record
                $arrestedItem['form_data_id'] = $formId; // Add form_data_id to each arrested accused item
                ArrestedAccused::create($arrestedItem); // Use the create method for mass assignment
            }
        }
        if (!empty($MobileData)){
            foreach($MobileData as $MobileItem){
                $MobileItem['form_data_id'] = $formId;
                AccusedMobiles::create($MobileItem);
            }
        }

        // Redirect or return response
        return redirect()->back()->with('success', 'Form submitted and data saved successfully.');

        // // Prepare arrays with fetched form ID for accused and arrested accused
        // $accusedArray = [];
        // if (!empty($accusedData)) {
        //     foreach ($accusedData as $accusedItem) {
        //         $accusedArray[] = [
        //             'form_data_id' => $formId, // Assign the form_data_id
        //             'accused_data' => $accusedItem
        //         ];
        //     }
        // }

        // $arrestedAccusedArray = [];
        // if (!empty($arrestedAccusedData)) {
        //     foreach ($arrestedAccusedData as $arrestedItem) {
        //         $arrestedAccusedArray[] = [
        //             'form_data_id' => $formId, // Assign the form_data_id
        //             'arrested_data' => $arrestedItem
        //         ];
        //     }
        // }

        // // Debugging output to ensure data is fetched and structured correctly
        // echo '<pre>';
        // echo "Form Data ID: $formId\n";
        // echo "\nAccused Data:\n";
        // print_r($accusedArray);

        // echo "\nArrested Accused Data:\n";
        // print_r($arrestedAccusedArray);
        // echo '</pre>';
        // exit; // Stop execution for debugging


    }
}