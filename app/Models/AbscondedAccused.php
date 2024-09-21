<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbscondedAccused extends Model
{
    protected $table = 'absconded_accused';
    protected $guarded = [];

    public function AbscondedAccused($nbwData)
    {
        foreach($abscondedData as $data){
            $this->create($data);
        }
        
    }
}

