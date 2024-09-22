<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEmployee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];

    public function employees()
    {
        return $this->hasMany(MasterUser::class, 'employee_id');
    }
}
