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

         // Initialize an array to store the associative array
         $outputData = [];
 
         // Loop through each row in the sheet data
        foreach ($sheetData as $row) {
            $rowData = [];
            foreach ($headers as $index => $header) {
                // Split the values based on pipelines for specific fields
                if (in_array($header, [
                    'Name of the accused persons',
                    'Alias',
                    'Fathers Name',
                    'Address of the accused persons',
                    'Name of the accused arrested',
                    'Name of the accused against whom NBW issued',
                    'status of NBW execution',
                    'Mobile Number (all SIM) of the phone seized',
                    'IMEI (all SIM) of the phone seized',
                    'Name of the accused released on bail',
                    'Date of the accused released on bail'
                ])) {
                    $rowData[$header] = explode('|', $row[$index]);
                } else {
                    $rowData[$header] = $row[$index] ?? null;
                }
            }



            // Create subarrays
            $rowData['accused_details'] = [
                'name' => $rowData['Name of the accused persons'] ?? [],
                'alias' => $rowData['Alias'] ?? [],
                'fathers_name' => $rowData['Fathers Name'] ?? [],
                'address' => $rowData['Address of the accused persons'] ?? [],
            ];

            $rowData['mobiles_recovered'] = [
                'mobile_numbers' => $rowData['Mobile Number (all SIM) of the phone seized'] ?? [],
                'imei_numbers' => $rowData['IMEI (all SIM) of the phone seized'] ?? [],
            ];

            $rowData['arrested_accused'] = $rowData['Name of the accused arrested'] ?? [];
            $rowData['nbw_accused'] = [
                'name' => $rowData['Name of the accused against whom NBW issued'] ?? [],
                'status' => $rowData['status of NBW execution'] ?? [],
            ];
            $rowData['released_accused'] = [
                'name' => $rowData['Name of the accused released on bail'] ?? [],
                'date' => $rowData['Date of the accused released on bail'] ?? [],
            ];

            // echo '<pre>';
            // print_r($rowData['released_accused']);
            // echo '</pre>';

            // Remove original fields from main array
            unset(
                $rowData['Name of the accused persons'],
                $rowData['Alias'],
                $rowData['Fathers Name'],
                $rowData['Address of the accused persons'],
                $rowData['Mobile Number (all SIM) of the phone seized'],
                $rowData['IMEI (all SIM) of the phone seized'],
                $rowData['Name of the accused arrested'],
                $rowData['Name of the accused against whom NBW issued'],
                $rowData['status of NBW execution'],
                $rowData['Name of the accused released on bail'],
                $rowData['Date of the accused released on bail']
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
