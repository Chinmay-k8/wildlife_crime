<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_master_user_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterUserTable extends Migration
{
    public function up()
    {
        Schema::create('master_user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_number')->unique();
            $table->string('password');
            $table->foreignId('designation_id')->constrained('master_designation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_user');
    }
}
