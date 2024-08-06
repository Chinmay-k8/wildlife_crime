<?php

// app/Models/MasterUser.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'master_user';

    protected $fillable = [
        'name',
        'user_name',
        'email',
        'mobile_number',
        'password',
        'designation_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function designation()
    {
        return $this->belongsTo(MasterDesignation::class, 'designation_id');
    }
}
