<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_master_designation_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDesignationTable extends Migration
{
    public function up()
    {
        Schema::create('master_designation', function (Blueprint $table) {
            $table->id();
            $table->string('designation_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_designation');
    }
}
