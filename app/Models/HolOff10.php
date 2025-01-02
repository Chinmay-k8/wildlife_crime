<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolOff10 extends Model
{
    use HasFactory;

    protected $table = 'holding_investigating_officer_form10'; 
    protected $guarded = [];

    public function saveInOff($HolOffData)
    {
        // Save multiple accused records
        foreach ($HolOfFData as $data) {
            $this->create($data);
        }
    }
}
