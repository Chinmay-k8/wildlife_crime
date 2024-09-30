<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterEmployee;
use App\Models\MasterUser;
use App\Models\Division;
use App\Models\UserArea;

class UserController extends Controller
{   
    public function showUserList()
    {
        // Pass the data to the view
        return view('userlist');
    }

    public function fetchData()
    {
        // Fetch all users with their employee, designation, area, and division details
        $users = MasterUser::with([
            'employee', // Relationship with MasterEmployee
            'designation', // Relationship with MasterDesignation
            'user_area' => function($query) {
                $query->with('division'); // Include division details
            }
        ])->get();

        // Return the data as JSON
        return response()->json($users);
    }
}
?>
