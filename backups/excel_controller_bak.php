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

         // Extract headers
         $headers = array_shift($sheetData);
        // echo '<pre>';
        //     print_r($headers);
        //     echo '</pre>';
        // exit;
         // Initialize an array to store the associative array
         $outputData = [];
        
         // Define the mapping of cell numbers to key names
        $keyMapping = [
            0 => 'serial_number', // Example mapping
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
            13 => 'dectection_agency',
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
            41 => 'court_forward_date',
            32 => 'nbw_accused_name',
            33 => 'nbw_accused_status',
            34 => 'court_name',
            35 => 'court_case_number',
            36 => 'released_accused_name',
            37 => 'released_accused_date',
            38 => 'pr_status',
            39 => 'action_against_staff',
            40 => 'case_present_status'

            // Add more mappings as needed
        ];
          // Loop through each row in the sheet data
        foreach ($sheetData as $row) {
            $rowData = [];

            foreach ($keyMapping as $cellIndex => $keyName) {
                // Split the values based on pipelines for specific fields
                if (in_array($keyName, [
                    'accused_name', // Example field that requires splitting
                    'accused_alias',
                    'accused_father',
                    'accused_address',
                    'arrested_accused_name',
                    'nbw_accused_name',
                    'nbw_accused_status',
                    'accused_mobile',
                    'accused_imei',
                    'released_accused_name',
                    'released_accused_date'
                ])) {
                    $rowData[$keyName] = explode('|', $row[$cellIndex]);
                } else {
                    $rowData[$keyName] = $row[$cellIndex] ?? null;
                }
            }


            // Create subarrays
            $rowData['accused'] = [
                'name' => $rowData['accused_name'] ?? [],
                'alias' => $rowData['accused_alias'] ?? [],
                'father_name' => $rowData['accused_father'] ?? [],
                'address' => $rowData['accused_address'] ?? [],
            ];

            $rowData['accused_mobile'] = [
                'mobile_no' => $rowData['accused_mobile'] ?? [],
                'imei_no' => $rowData['accused_imei'] ?? [],
            ];

            $rowData['arrested_accused'] = ['name' => $rowData['arrested_accused_name'] ?? [],];
            $rowData['nbw_accused'] = [
                'name' => $rowData['nbw_accused_name'] ?? [],
                'status' => $rowData['nbw_accused_status'] ?? [],
            ];
            $rowData['released_accused'] = [
                'name' => $rowData['released_accused_name'] ?? [],
                'date' => $rowData['released_accused_date'] ?? [],
            ];


            // echo '<pre>';
            // print_r($rowData['released_accused']);
            // echo '</pre>';

            // Remove original fields from main array
            unset(
                $rowData['serial_number'],
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
                $rowData['released_accused_date']
            );

            // echo '<pre>';
            // print_r($rowData['released_accused']);
            // echo '</pre>';


            

            $outputData[] = $rowData;
        }
 
        $userId = Auth::user()->id;

        $output = [
            'user_id' => $userId,
            'data' => $outputData,
        ];
        // Print the data as a POST array
            
        echo '<pre>';
        print_r($output);
        echo '</pre>';
        exit;
        return;
    }
    // public function upload(Request $request)
    // {
    //     $request->validate([
    //         'excel_file' => 'required|file|mimes:xlsx,xls',
    //     ]);

    //     $file = $request->file('excel_file');

    //     // Load the uploaded file into PhpSpreadsheet
    //     $spreadsheet = IOFactory::load($file->getRealPath());

    //     // Assuming you want the data from the first worksheet
    //     $worksheet = $spreadsheet->getActiveSheet();

    //     // Convert the worksheet data into an array
    //     $sheetData = $worksheet->toArray();
    //     // Extract headers
    //     $headers = array_shift($sheetData);

    //     // Initialize an array to store the associative array
    //     $outputData = [];

    //     // Loop through each row in the sheet data
    //     foreach ($sheetData as $row) {
    //         $rowData = [];

    //         // Create subarrays directly without an additional function
    //         $rowData['accused_details'] = [
    //             'Name of the accused persons' => array_map('trim', explode('|', $row[array_search('Name of the accused persons', $headers)] ?? '')),
    //             'Alias' => array_map('trim', explode('|', $row[array_search('Alias', $headers)] ?? '')),
    //             'Fathers Name' => array_map('trim', explode('|', $row[array_search('Fathers Name', $headers)] ?? '')),
    //             'Address of the accused persons' => array_map('trim', explode('|', $row[array_search('Address of the accused persons', $headers)] ?? '')),
    //         ];

    //         $rowData['mobiles_recovered'] = [
    //             'Mobile Number (all SIM) of the phone seized' => array_map('trim', explode('|', $row[array_search('Mobile Number (all SIM) of the phone seized', $headers)] ?? '')),
    //             'IMEI (all SIM) of the phone seized' => array_map('trim', explode('|', $row[array_search('IMEI (all SIM) of the phone seized', $headers)] ?? '')),
    //         ];

    //         $rowData['arrested_accused'] = [
    //             'Name of the accused arrested' => array_map('trim', explode('|', $row[array_search('Name of the accused arrested', $headers)] ?? '')),
    //         ];

    //         $rowData['nbw_accused'] = [
    //             'Name of the accused against whom NBW issued' => array_map('trim', explode('|', $row[array_search('Name of the accused against whom NBW issued', $headers)] ?? '')),
    //             'status of NBW execution' => array_map('trim', explode('|', $row[array_search('status of NBW execution', $headers)] ?? '')),
    //         ];

    //         $rowData['released_accused'] = [
    //             'Name of the accused released on bail' => array_map('trim', explode('|', $row[array_search('Name of the accused released on bail', $headers)] ?? '')),
    //             'Date of the accused released on bail' => array_map('trim', explode('|', $row[array_search('Date of the accused released on bail', $headers)] ?? '')),
    //         ];

    //         // Add other fields to the row data
    //         foreach ($headers as $index => $header) {
    //             if (!isset($rowData['accused_details'][$header]) && 
    //                 !isset($rowData['mobiles_recovered'][$header]) && 
    //                 !isset($rowData['arrested_accused'][$header]) && 
    //                 !isset($rowData['nbw_accused'][$header]) && 
    //                 !isset($rowData['released_accused'][$header])) {
    //                 $rowData[$header] = $row[$index] ?? null;
    //             }
    //         }

    //         $outputData[] = $rowData;
    //     }

    //     $userId = Auth::user()->id;

    //     $output = [
    //         'user_id' => $userId,
    //         'data' => $outputData,
    //     ];

    //     // Print the associative array
    //     echo '<pre>';
    //     print_r($output);
    //     echo '</pre>';
    //     exit;
    // }

}
