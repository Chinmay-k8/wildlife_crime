<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ank_Range extends Model
{
    use HasFactory;
    protected $connection = 'anukampa';
    protected $table = 'master_area_range';
    public function division(){
        return $this->belongsTo(ank_Range::class, 'parent_id');
    }
}
