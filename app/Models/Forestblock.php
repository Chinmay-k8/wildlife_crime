<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forestblock extends Model
{

    protected $connection = 'secondary'; // Specify the connection name
    protected $table = 'master_area_forest_block'; // Specify the table name

}
