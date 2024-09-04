<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\Accused;
use App\Models\ArrestedAccused;
use App\Models\ReleasedAccused;
use App\Models\AccusedMobiles;
use App\Models\NbwAccused;

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

        // Extract headers
        $headers = array_shift($sheetData);
        // echo '<pre>'; print_r($headers); echo '</pre>';exit;
        // Define the mapping of cell numbers to key names
        $keyMapping = [
            0 => 'serial_number',
            1 => 'division',
            2 => 'range',
            3 => 'section',
            4 => 'beat',
            5 => 'case_type',
            6 => 'case_no',
            7 => 'case_date',
            8 => 'penal_code',
            9 => 'detection_date',
            10 => 'detection_place',
            11 => 'latitude',
            12 => 'longitude',
            13 => 'detection_agency',
            14 => 'investigating_agency',
            15 => 'species_name',
            16 => 'species_age',
            17 => 'species_sex',
            18 => 'old_wlpa',
            19 => 'property_recovered_type',
            20 => 'property_recovered_details',
            21 => 'brief_fact',
            22 => 'officer_name',
            23 => 'officer_number',
            24 => 'accused_name',
            25 => 'accused_alias',
            26 => 'accused_father',
            27 => 'accused_address',
            28 => 'accused_mobile',
            29 => 'accused_imei',
            30 => 'arrested_accused_name',
            31 => 'court_forward_date',
            32 => 'nbw_accused_name',
            33 => 'nbw_accused_status',
            34 => 'court_name',
            35 => 'court_case_number',
            36 => 'released_accused_name',
            37 => 'released_accused_date',
            38 => 'pr_status',
            39 => 'action_against_staff',
            40 => 'case_present_status'
        ];

        // Loop through each row in the sheet data
        foreach ($sheetData as $row) {
            $rowData = [];

            foreach ($keyMapping as $cellIndex => $keyName) {
                if (isset($row[$cellIndex])) {  
                    $value = $row[$cellIndex] ?? null;
            
                    // Convert dates if needed
                    if (in_array($keyName, ['case_date', 'detection_date', 'court_forward_date', 'released_accused_date'])) {
                        $value = $this->convertToDate($value);
                    }
            
                    // Set empty values to null
                    $rowData[$keyName] = empty($value) ? null : $value;
                } else {
                    $rowData[$keyName] = null; // Handle the case where the cell is not set
                }
            }

             // Separate subarrays for related tables
             $accusedData = [
                'name' => explode('|', $rowData['accused_name'] ?? ''),
                'alias' => explode('|', $rowData['accused_alias'] ?? ''),
                'father_name' => explode('|', $rowData['accused_father'] ?? ''),
                'address' => explode('|', $rowData['accused_address'] ?? ''),
            ];

            $accusedMobileData = [
                'mobile_no' => explode('|', $rowData['accused_mobile'] ?? ''),
                'imei_no' => explode('|', $rowData['accused_imei'] ?? ''),
            ];

            $arrestedAccusedData = ['name' => explode('|', $rowData['arrested_accused_name'] ?? '')];
            $nbwAccusedData = [
                'name' => explode('|', $rowData['nbw_accused_name'] ?? ''),
                'status' => explode('|', $rowData['nbw_accused_status'] ?? ''),
            ];
            $releasedAccusedData = [
                'name' => explode('|', $rowData['released_accused_name'] ?? ''),
                'date' => explode('|', $rowData['released_accused_date'] ?? ''),
            ];

            // echo '<pre>'; print_r($rowData); echo '</pre>';exit;
            unset($rowData['serial_number'],
            $rowData['accused_name'],
            $rowData['accused_alias'],
            $rowData['accused_father'],
            $rowData['accused_address'],
            $rowData['accused_mobile'],
            $rowData['accused_imei'],
            $rowData['arrested_accused_name'],
            $rowData['nbw_accused_name'],
            $rowData['nbw_accused_status'],
            $rowData['released_accused_name'],
            $rowData['released_accused_date']  );  
            
            // echo '<pre>'; print_r($rowData); echo '</pre>';exit;

            $formData = $rowData;
            // echo '<pre>'; print_r($formData); echo '</pre>';exit;

            $formData['user_id'] = Auth::id();
            $form = Form::create($formData);
            $formId = $form->id;

            // Debug: Make sure form ID is saved and fetched correctly
            if (!$formId) {
                return redirect()->back()->withErrors('Failed to save form data.');
            }
           foreach ($accusedData['name'] as $index => $name) {
                Accused::create([
                    'form_data_id' => $formId,
                    'name' => $name,
                    'alias' => $accusedData['alias'][$index] ?? null,
                    'father_name' => $accusedData['father_name'][$index] ?? null,
                    'address' => $accusedData['address'][$index] ?? null,
                ]);
            }

            foreach ($accusedMobileData['mobile_no'] as $index => $mobile) {
                AccusedMobiles::create([
                    'form_data_id' => $formId,
                    'mobile_no' => $mobile,
                    'imei_no' => $accusedMobileData['imei_no'][$index] ?? null,
                ]);
            }

            foreach ($arrestedAccusedData['name'] as $name) {
                ArrestedAccused::create([
                    'form_data_id' => $formId,
                    'name' => $name,
                ]);
            }

            foreach ($nbwAccusedData['name'] as $index => $name) {
                NbwAccused::create([
                    'form_data_id' => $formId,
                    'name' => $name,
                    'status' => $nbwAccusedData['status'][$index] ?? null,
                ]);
            }

            foreach ($releasedAccusedData['name'] as $index => $name) {
                ReleasedAccused::create([
                    'form_data_id' => $formId,
                    'name' => $name,
                    'date' => !empty($releasedAccusedData['date'][$index]) ? $releasedAccusedData['date'][$index] : null,
                ]);
            }

           
        }
        
        return redirect()->back()->with('success', 'Data imported and saved successfully.');
    }
    private function convertToDate($date)
    {
        // Try different date formats
        $formats = ['d.m.Y', 'd/m/Y', 'Y.m.d', 'Y/m/d'];
        
        foreach ($formats as $format) {
            $parsedDate = \DateTime::createFromFormat($format, $date);
            if ($parsedDate !== false) {
                return $parsedDate->format('Y-m-d');
            }
        }
        
        // Return null or handle invalid date formats
        return null;
    }
}