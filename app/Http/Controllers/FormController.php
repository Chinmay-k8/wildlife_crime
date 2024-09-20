<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form; 
use App\Models\Accused; 
use App\Models\ArrestedAccused;
use App\Models\ReleasedAccused;
use App\Models\AccusedMobiles;
use App\Models\NbwAccused;
use App\Models\Uploads;
use App\Models\AdditionalPr;


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
        $formData = $request->except(['accused', 'arrested_accused', 'accused_mobile', 'released_accused', 'nbw_accused', 'post_mortem_report', 'electrical_inspector_report', 
        'laboratory_report', 'court_judgement', 'lat_deg', 'lat_min', 'lat_sec', 'long_deg', 'long_min', 'long_sec', 'case_part_1', 'case_year', 'additional_pr' ]);
        $case_part_1 = $request->input('case_part_1'); // e.g. "132"
        $case_year = $request->input('case_year');     // e.g. "2005"
        $formData['court_case_number'] = "2(b) CC No {$case_part_1} of {$case_year}";
        // print_r($formData);
        // echo '</pre>';
        // exit; // Stop execution for debugging
        $accusedData = $request->input('accused');
        $arrestedAccusedData = $request->input('arrested_accused');
        $MobileData = $request->input('accused_mobile');
        $ReleasedData = $request->input('released_accused');
        $NbwData = $request->input('nbw_accused');
        $additionalprData = $request->input('additional_pr');

        $formData['user_id'] = Auth::id(); // Include user_id from Auth
        $latitude_deg = $request->input('lat_deg');
        $latitude_min = $request->input('lat_min');
        $latitude_sec = $request->input('lat_sec');
        $latitude_decimal = $latitude_deg + ($latitude_min / 60) + ($latitude_sec / 3600);

        // Convert Longitude (DMS) to Decimal Degrees
        $longitude_deg = $request->input('long_deg');
        $longitude_min = $request->input('long_min');
        $longitude_sec = $request->input('long_sec');
        $longitude_decimal = $longitude_deg + ($longitude_min / 60) + ($longitude_sec / 3600);

        // Store the calculated Decimal Degrees in formData array
        $formData['latitude'] = $latitude_decimal;
        $formData['longitude'] = $longitude_decimal;

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
        if (!empty($ReleasedData)){
            foreach($ReleasedData as $ReleasedItem){
                $ReleasedItem['form_data_id'] = $formId;
                ReleasedAccused::create($ReleasedItem);
            }
        }
        if(!empty($NbwData)){
            foreach($NbwData as $NbwItem){
                $NbwItem['form_data_id'] = $formId;
                NbwAccused::create($NbwItem);
            }
        }
        if(!empty($additionalprData)){
            foreach($additionalprData as $additionalprItem){
                $additionalprItem['form_data_id'] = $formId;
                AdditionalPr::create( $additionalprItem);
            }
        }
        // Handle file uploads
        $uploadsData = [
            'form_data_id' => $formId,
            'post_mortem_report' => $this->handleFileUpload($request->file('post_mortem_report'), 'post-mortem-report', $formId),
            'electrical_inspector_report' => $this->handleFileUpload($request->file('electrical_inspector_report'), 'electrical-inspector-report', $formId),
            'laboratory_report' => $this->handleFileUpload($request->file('laboratory_report'), 'laboratory-report', $formId),
            'court_judgement' => $this->handleFileUpload($request->file('court_judgement'), 'court-judgement', $formId),
        ];

        // Save upload details
        $uploads = new Uploads();
        $uploads->saveUploads($uploadsData);

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
    public function handleFileUpload($file, $type, $formId)
    {
        if ($file) {

            $dateTime = now()->format('dmy_His');
            $fileName = $formId . '_' . $dateTime . '_' . $file->getClientOriginalName();

            // Save the file to the appropriate subfolder inside 'uploads'
            $file->storeAs('uploads/' . $type, $fileName, 'public');

            return $fileName; // Return the file path to be saved in the database
        }
        return null; // Return null if no file was uploaded
    }
    public function updateForm(Request $request, $id)
    {
        $requestData = $request->all();
        $accusedData = $request->input('accused') ?? 'No accused data';
        $arrestedAccusedData = $request->input('arrested_accused') ?? 'No arrested accused data';
        $accusedMobileData = $request->input('accused_mobile') ?? 'No accused mobile data';
        $releasedAccusedData = $request->input('released_accused') ?? 'No released accused data';
        $nbwAccusedData = $request->input('nbw_accused') ?? 'No NBW accused data';
    
        // Print all request data including subarrays
        dd([
            'Request Data' => $requestData,
            'Accused' => $accusedData,
            'Arrested Accused' => $arrestedAccusedData,
            'Accused Mobiles' => $accusedMobileData,
            'Released Accused' => $releasedAccusedData,
            'NBW Accused' => $nbwAccusedData,
        ]);
        // dd($request->all());

        // Fetch form by ID and update main form data
        $form = Form::findOrFail($id); // Find the form by its ID
        $formData = $request->except(['accused', 'arrested_accused', 'accused_mobile', 'released_accused', 'nbw_accused']);
        $form->update($formData);

        // Update accused details
        Accused::where('form_data_id', $id)->delete(); // Delete existing accused records
        if (!empty($request->input('accused'))) {
            foreach ($request->input('accused') as $accusedItem) {
                $accusedItem['form_data_id'] = $id;
                Accused::create($accusedItem);
            }
        }

        // Update arrested accused details
        ArrestedAccused::where('form_data_id', $id)->delete(); // Delete existing arrested accused records
        if (!empty($request->input('arrested_accused'))) {
            foreach ($request->input('arrested_accused') as $arrestedItem) {
                $arrestedItem['form_data_id'] = $id;
                ArrestedAccused::create($arrestedItem);
            }
        }

        // Similar logic for mobiles, released accused, and nbw accused tables...

        // Update uploaded documents
        $uploadsData = [
            'post_mortem_report' => $this->handleFileUpload($request->file('post_mortem_report'), 'post-mortem-report', $id),
            'electrical_inspector_report' => $this->handleFileUpload($request->file('electrical_inspector_report'), 'electrical-inspector-report', $id),
            'laboratory_report' => $this->handleFileUpload($request->file('laboratory_report'), 'laboratory-report', $id),
            'court_judgement' => $this->handleFileUpload($request->file('court_judgement'), 'court-judgement', $id),
        ];
        Uploads::where('form_data_id', $id)->update($uploadsData);

        return response()->json(['success' => 'Form updated successfully!']);
    }

}
