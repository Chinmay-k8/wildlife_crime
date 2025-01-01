<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ank_Section extends Model
{
    use HasFactory;
    protected $connection = 'anukampa';
    protected $table = 'master_area_section';
    public function range(){
        return $this->belongsTo(ank_Section::class, 'parent_id');
    }
}
