<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ank_Division extends Model
{
    use HasFactory;
    protected $connection = 'anukampa';
    protected $table = 'master_area_division'; 
    public function circle()
    {
        return $this->belongsTo(ank_Division::class, 'parent_id'); // parent_id is the circle ID
    }
}
