<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
    use HasFactory;
    protected $table = 'user_area';
    protected $fillable = [
        'user_id',  // Add this line to allow user_id to be mass assignable
        'area_id',  // Also add area_id if you're mass assigning it too
    ];

}
