<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consultings')->insert
        (
            [
                ['name' => 'Medical consultating'],
                ['name' => 'Vocational consulting'],
                ['name' => 'Psychological counseling'],
                ['name' => 'Family counseling'],
                ['name' => 'Business consulting'],
            ]
        );
    }
}
