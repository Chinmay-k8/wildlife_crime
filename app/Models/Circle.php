<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    use HasFactory;
    protected $connection = 'secondary'; // Specify the connection name
    protected $table = 'master_area_circle'; // Specify the table name
}
