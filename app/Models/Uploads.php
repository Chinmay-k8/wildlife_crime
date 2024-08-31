<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected $table = 'uploads';
    protected $guarded = [];

    public function saveUploads($uploadData)
    {
        // Save each document with its corresponding form_data_id
        $this->create($uploadData);
    }
}
