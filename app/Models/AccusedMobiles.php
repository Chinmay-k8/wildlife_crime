<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccusedMobiles extends Model
{
    protected $table = 'accused_mobile'; 
    protected $guarded = [];

    public function saveMobile($MobileData)
    {
        // Save multiple accused records
        foreach ($MobileData as $data) {
            $this->create($data);
        }
    }
}
