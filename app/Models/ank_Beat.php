<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ank_Beat extends Model
{
    use HasFactory;
    protected $connection = 'anukampa';
    protected $table = 'master_area_beat';

    public function range(){
        return $this->belongsTo(ank_Range::class, 'parent_id');
    }
    public function state()
    {
        return $this->belongsTo(ank_Circle::class, 'parent_id'); 
    }
}
