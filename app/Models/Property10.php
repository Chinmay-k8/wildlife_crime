<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property10 extends Model
{
    use HasFactory;
    protected $table = 'property_form10';
    protected $guarded = [];

    public function saveProperty($propertyData)
    {
        // Save multiple arrested accused records
        foreach ($propertyData as $data) {
            $this->create($data);
        }
    }
}
