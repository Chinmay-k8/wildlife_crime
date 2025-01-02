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
use App\Models\AbscondedAccused;
use App\Models\SpeciesInvolved;
use App\Models\UserArea;
use App\Models\Division;
use App\Models\Circle;

class Form1Controller extends Controller{
    function showForm1(){
        $user = auth()->user();
        $designationId = $user->designation_id;
    
        // Fetch user's area (division or circle ID) from the UserArea table
        $userArea = UserArea::where('user_id', $user->id)->first();
        $selectedarea = $userArea ? $userArea->area_id : null;
        
        if ($selectedarea) {
            if (in_array($designationId, [4, 5, 6])) {
                // For designation 4, 5, 6, prefill circle and division
                $division = Division::find($selectedarea);
                $selectedCircle = $division ? $division->parent_id : null;  // Circle ID stored in parent_id
                $circles = Circle::where('id', $selectedCircle)->get(); // Only fetch the user's circle
                $divisions = Division::where('id', $selectedarea)->get(); // Fetch relevant divisions
            } else {
                // For other designations, allow dynamic selection of circle and division
                $circles = Circle::whereNotIn('id', [11])->get(); // Fetch all circles except id 11
                $selectedCircle = null;  // Let the frontend handle the circle selection
                $divisions = []; // Divisions will be populated dynamically based on selected circle
            }
        }

        return view('form1_report', compact('selectedCircle', 'selectedarea', 'circles', 'divisions', 'designationId'));
    }
    function reportForm1(Request $request){

        
        // print_r($request->all());
        // echo '</pre>';
        // exit; 
        
    }
}