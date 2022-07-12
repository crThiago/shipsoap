<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            [
                'company_id' => 1,
                'name' => 'Falcon Heavy'
            ],
            [
                'company_id' => 1,
                'name' => 'Falcon 9'
            ],
            [
                'company_id' => 2,
                'name' => 'New Shepard'
            ],
            [
                'company_id' => 3,
                'name' => 'Soyuz'
            ],
            [
                'company_id' => 4,
                'name' => 'Hyperbola-2'
            ]
        ]);
    }
}
