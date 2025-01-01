<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form1 extends Model{
    select * from public.damage_application 
    where payment_type in ('STS','RET','ACKCOR') and payment_error_code = '000000' and active = 1

}