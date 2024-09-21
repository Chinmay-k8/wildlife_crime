<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleasedAccused extends Model
{
    protected $table = 'released_accused';
    protected $guarded = [];

    public function saveReleasedAccused($releasedData)
    {
        // Save multiple arrested accused records
        foreach ($releasedData as $data) {
            $this->create($data);
        }
    }
}