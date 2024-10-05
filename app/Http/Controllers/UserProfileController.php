<?php 
namespace App\Http\Controllers;

use App\Models\MasterUser;
use App\Models\MasterEmployee;
use App\Models\MasterDesignation;
use App\Models\UserArea;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    public function getProfile()
    {
        // Fetch the currently authenticated user with related data
        $user = MasterUser::with([
            'employee', // Relationship with MasterEmployee
            'designation', // Relationship with MasterDesignation
            'user_area' => function($query) {
                $query->with('division'); // Include division details
            }
        ])->find(Auth::id());

        // Return the data as JSON
        return response()->json($user);
    }
}
?>