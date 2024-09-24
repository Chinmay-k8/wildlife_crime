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
use App\Models\Circle;
use App\Models\Division;
use App\Models\Range;
use App\Models\Section;
use App\Models\Beat;
use App\Models\Forestblock;
use Illuminate\Support\Facades\Storage;


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
        $circleId = $request->input('circle');
        $division = $request->input('division');

        // Load the uploaded file into PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getRealPath());

      
        $worksheet = $spreadsheet->getActiveSheet();

        // Convert the worksheet data into an array
        $sheetData = $worksheet->toArray();
        array_shift($sheetData);
        // Extract headers
        // $headers = array_shift($sheetData);
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
            10 => 'detection_place_type',
            11 => 'detection_place',
            12 => 'latitude_degree',
            13 => 'latitude_minutes',
            14 => 'latitude_seconds',
            15 => 'longitude_degree',
            16 => 'longitude_minutes',
            17 => 'longitude_seconds',
            18 => 'detection_agency',
            19 => 'investigating_agency',
            20 => 'schedule_type',
            21 => 'species_name',
            22 => 'species_age',
            23 => 'species_sex',
            24 => 'species_schedule',
            25 => 'property_recovered_type',
            26 => 'property_recovered_details',
            27 => 'brief_fact',
            28 => 'in_officer_name',
            29 => 'in_officer_mobile',
            30 => 'accused_mobile',
            31 => 'accused_imei',
            32 => 'arrested_accused_name',
            33 => 'court_forward_date',
            34 => 'nbw_accused_name',
            35 => 'nbw_accused_status',
            36 => 'detected_absconded_accused_option',
            37 => 'no_of_detected_absconded_accused',
            38 => 'absconded_accused_name',
            39 => 'undetected_absconded_accused_option',
            40 => 'no_of_undetected_absconded_accused',
            41 => 'court_name',
            42 => 'court_case_number',
            43 => 'released_accused_name',
            44 => 'released_accused_date',
            45 => 'pr_number',
            46 => 'pr_date',
            47 => 'pr_status',
            48 => 'additional_pr_option',
            49 => 'additional_pr_number',
            50 => 'additional_pr_date',
            51 => 'additional_pr_status',
            52 => 'action_against_staff',
            53 => 'case_present_status'
        ];
         // Array to collect errors
         $validationErrors = [];

        // Loop through each row in the sheet data
        foreach ($sheetData as $rowIndex => $row) {
            $rowData = [];

            foreach ($keyMapping as $cellIndex => $keyName) {
                if (isset($row[$cellIndex])) {  
                    $value = $row[$cellIndex] ?? null;
            
                    // Convert dates if needed
                    if (in_array($keyName, ['case_date', 'detection_date', 'court_forward_date', 'released_accused_date'])) {
                        $value = $this->convertToDate($value);
                    }
                    
                     // Validate and convert values using models
                    if ($keyName === 'division') {
                        $divisionId = $this->validateDivisionWithModel($value, $division); 
                        if (!$divisionId) {
                                $validationErrors[] = "Row " . ($rowIndex + 2) . ": Division '{$value}' does not belong to the provided division.";
                        }
                        $value = $divisionId;
                    } elseif ($keyName === 'range') {
                        $rangeId = $this->validateRangeWithModel($value, $divisionId); 
                        if (!$rangeId) {
                            if (!$rangeId) {
                                $validationErrors[] = "Row " . ($rowIndex + 2) . ": Range '{$value}' does not belong to the entered division.";
                            }
                        }
                        $value = $rangeId;
                    } elseif ($keyName === 'section') {
                        $sectionId = $this->validateSectionWithModel($value, $rangeId); 
                        if (!$sectionId) {
                            if (!$sectionId) {
                                $validationErrors[] = "Row " . ($rowIndex + 2) . ": Section '{$value}' does not belong to the entered range.";
                            }
                        }
                        $value = $sectionId;
                    } elseif ($keyName === 'beat') {
                        $beatId = $this->validateBeatWithModel($value, $sectionId); 
                        if (!$beatId) {
                            if (!$beatId) {
                                $validationErrors[] = "Row " . ($rowIndex + 2) . ": Beat '{$value}' does not belong to the entered section.";
                            }
                        }
                        $value = $beatId;
                    }
                    // Set empty values to null
                    $rowData[$keyName] = empty($value) ? null : $value;

                } else {
                    $rowData[$keyName] = null; // Handle the case where the cell is not set
                }
                if (!empty($validationErrors)) {
                    return redirect()->back()->withErrors($validationErrors);
                }
            }

             // Separate subarrays for related tables
             $accusedData = [
                'accused_name' => explode('|', $rowData['accused_name'] ?? ''),
                'accused_alias' => explode('|', $rowData['accused_alias'] ?? ''),
                'father_name' => explode('|', $rowData['accused_father'] ?? ''),
                'address' => explode('|', $rowData['accused_address'] ?? ''),
            ];

            $accusedMobileData = [
                'mobile_no' => explode('|', $rowData['accused_mobile'] ?? ''),
                'imei_no' => explode('|', $rowData['accused_imei'] ?? ''),
            ];

            $arrestedAccusedData = ['accused_name' => explode('|', $rowData['arrested_accused_name'] ?? '')];
            $nbwAccusedData = [
                'accused_name' => explode('|', $rowData['nbw_accused_name'] ?? ''),
                'nbw_status' => explode('|', $rowData['nbw_accused_status'] ?? ''),
            ];
            $releasedAccusedData = [
                'accused_name' => explode('|', $rowData['released_accused_name'] ?? ''),
                'bail_date' => explode('|', $rowData['released_accused_date'] ?? ''),
            ];
            $abscondedAccusedData = [
                'accused_name' => explode('|', $rowData['absconded_accused_name'] ?? '')
            ];

            $additionalPrData = [
                'number' => explode('|', $rowData['additional_pr_number'] ?? ''),
                'date' => explode('|', $rowData['additional_pr_date'] ?? ''),
                'status' => explode('|', $rowData['additional_pr_status'] ?? ''),
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
            $rowData['released_accused_date'],
            $rowData['absconded_accused_name'],
            $rowData['additional_pr_number'],
            $rowData['additional_pr_date'],
            $rowData['additional_pr_status'] );  
            
            // echo '<pre>'; print_r($rowData); echo '</pre>';exit;
            $rowData['circle'] = $circleId;
            $formData = $rowData;
            // echo '<pre>'; print_r($formData); echo '</pre>';exit;

            $formData['user_id'] = Auth::id();
            $form = Form::create($formData);
            $formId = $form->id;

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

    private function validateDivisionWithModel($divisionName, $divisionId)
    {
        // Fetch the division by its name and circle (parent_id)
        $division = Division::where('name_e', trim($divisionName))
            ->where('id', $divisionId)
            ->first();

        return $division ? $division->id : null;
    }
    private function validateRangeWithModel($rangeName, $divisionId)
    {
        
        $range= Range::where('name_e', trim($rangeName))
            ->where('parent_id', $divisionId)
            ->first();

        return $range ? $range->id : null;
    }
    private function validateSectionWithModel($sectionName, $rangeId)
    {
        $section= Section::where('name_e', trim($sectionName))
            ->where('parent_id', $rangeId)
            ->first();

        return $section ? $section->id : null;
    }
    private function validateBeatWithModel($beatName, $sectionId)
    {
        $beat= Beat::where('name_e', trim($beatName))
            ->where('parent_id', $sectionId)
            ->first();

        return $beat ? $beat->id : null;
    }
    // private function validateForestblockWithModel($forestblockName, $divisionId)
    // {
    //     $forestblock= Forestblock::where('name_e', trim($forestblockName))
    //         ->where('parent_id', $divisionId)
    //         ->first();

    //     return $forestblock ? $forestblock->id : null;
    // }
    public function download_demo_excel()
    {
       
        $filePath = 'uploads/demo_excel.xlsx';
    
        // Check if the file exists in the storage
        if (Storage::disk('public')->exists($filePath)) {
            // Return the file as a response to download
            return Storage::disk('public')->download($filePath);
        }
    
        // If the file does not exist, return a 404 error
        abort(404, 'File not found.');
    }

}
