<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
<<<<<<< HEAD
    use HasFactory;
    
=======
    protected $table = 'uploads';
    protected $guarded = [];

    public function saveUploads($uploadData)
    {
        // Save each document with its corresponding form_data_id
        $this->create($uploadData);
    }
>>>>>>> ba9bd8767877a8e07a0051d862646507e9b2e9a8
}
