<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ank_Circle extends Model
{
    use HasFactory;
    protected $connection = 'anukampa';
    protected $table = 'master_area_circle'; 
    public function state()
    {
        return $this->belongsTo(ank_Circle::class, 'parent_id'); 
    }
}
