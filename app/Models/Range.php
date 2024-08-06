<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $connection = 'secondary'; // Specify the connection name
    protected $table = 'master_area_range'; // Specify the table name
}
