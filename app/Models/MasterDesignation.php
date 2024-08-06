<?php

// app/Models/MasterDesignation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDesignation extends Model
{
    use HasFactory;

    protected $table = 'master_designation';

    protected $fillable = [
        'designation_name',
    ];

    public function users()
    {
        return $this->hasMany(MasterUser::class, 'designation_id');
    }
}
