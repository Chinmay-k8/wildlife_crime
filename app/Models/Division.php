<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'master_area_division'; 
    public function circle()
    {
        return $this->belongsTo(Division::class, 'parent_id'); // parent_id is the circle ID
    }
}

