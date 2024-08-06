<?php

// database/seeders/MasterDesignationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDesignationSeeder extends Seeder
{
    public function run()
    {
        DB::table('master_designation')->insert([
            ['designation_name' => 'SO'],
            ['designation_name' => 'ACF'],
            ['designation_name' => 'DFO'],
            ['designation_name' => 'RCCF'],
        ]);
    }
}
