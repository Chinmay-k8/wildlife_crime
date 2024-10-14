<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    use HasFactory;
    protected $table = 'master_area_circle'; 
    public function state()
    {
        return $this->belongsTo(Circle::class, 'parent_id'); 
    }
}