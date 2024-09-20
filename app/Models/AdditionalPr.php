<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalPr extends Model
{
    use HasFactory;
    protected $table = 'additional_pr';
    protected $guarded = [];

    public function saveAdditionalPr($AdditionalPrData)
    {
        // Save multiple accused records
        foreach ($AdditionalPrData as $data) {
            $this->create($data);
        }
    }
}
