<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accused extends Model
{
    protected $table = 'accused'; 
    protected $guarded = [];

    public function saveAccused($accusedData)
    {
        // Save multiple accused records
        foreach ($accusedData as $data) {
            $this->create($data);
        }
    }
}

class ArrestedAccused extends Model
{
    protected $table = 'arrested_accused';
    protected $guarded = [];

    public function saveArrestedAccused($arrestedData)
    {
        // Save multiple arrested accused records
        foreach ($arrestedData as $data) {
            $this->create($data);
        }
    }
}