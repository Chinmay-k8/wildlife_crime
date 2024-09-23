<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrestedAccused extends Model
{
    protected $table = 'arrested_accused_form10';
    protected $guarded = [];

    public function saveArrestedAccused($arrestedData)
    {
        // Save multiple arrested accused records
        foreach ($arrestedData as $data) {
            $this->create($data);
        }
    }
}
