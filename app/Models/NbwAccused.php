<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NbwAccused extends Model
{
    protected $table = 'nbw_accused_form10';
    protected $guarded = [];

    public function saveNbwAccused($nbwData)
    {
        foreach($nbwData as $data){
            $this->create($data);
        }
        
    }
}