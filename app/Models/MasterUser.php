<?php

// app/Models/MasterUser.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'designation_id',
        'employee_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function designation()
    {
        return $this->belongsTo(MasterDesignation::class, 'designation_id');
    }
    public function employee()
    {
        return $this->belongsTo(MasterEmployee::class, 'employee_id');
    }
    public function user_area()
    {
        return $this->hasMany(UserArea::class, 'user_id');
    }
}
