<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{
    use HasFactory;
    protected $connection = 'secondary'; // Specify the connection name
    protected $table = 'master_area_beat'; // Specify the table nameclear 
}
