<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigatingOffForm10 extends Model
{
    use HasFactory;
    protected $table = 'investigating_officer_form10'; 
    protected $guarded = [];

    public function saveInOff($InOffData)
    {
        // Save multiple accused records
        foreach ($InOfFData as $data) {
            $this->create($data);
        }
    }

}   
