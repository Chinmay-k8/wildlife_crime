<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeciesInvolved extends Model
{
    
    protected $table = 'species_involved_form10';
    protected $guarded = [];

    public function saveSpeciesInvolved($speciesData)
    {
        // Save multiple arrested accused records
        foreach ($speciesData as $data) {
            $this->create($data);
        }
    }
}
