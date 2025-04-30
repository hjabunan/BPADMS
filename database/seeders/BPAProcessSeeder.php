<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BPAProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $process = [
            [
                'process_name' => 'General Operations',
                'process_weight' => '30%',
                'status' => 1,
                'key' => '45dccac8-af0b-4550-920e-677449c57352',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'process_name' => 'Documentation',
                'process_weight' => '20%',
                'status' => 1,
                'key' => '5768d2b6-242c-4ac8-89df-63015fd4c685',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'process_name' => 'Parts Management',
                'process_weight' => '20%',
                'status' => 1,
                'key' => 'f113a838-c5fd-4e1c-b473-86d320ac3fcb',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'process_name' => 'Personnel',
                'process_weight' => '20%',
                'status' => 1,
                'key' => '14416f7f-9073-4e34-98b8-7251b17241a3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'process_name' => '5S',
                'process_weight' => '10%',
                'status' => 1,
                'key' => '71cedced-54be-45f3-84a8-8645a5d8bb32',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('bpa_process')->insert($process);
    }
}
