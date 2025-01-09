<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherUploads10 extends Model{

    protected $table = 'other_uploads_form10';
    protected $guarded = [];

    public function saveOtherUploads($uploadData)
    {
        $this->create($uploadData);
    }
}
