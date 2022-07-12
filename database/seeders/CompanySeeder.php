<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'id' => 1,
                'name' => 'SpaceX',
                'country' => 'EUA'
            ],
            [
                'id' => 2,
                'name' => 'Blue Origin',
                'country' => 'EUA'
            ],
            [
                'id' => 3,
                'name' => 'Roscosmos',
                'country' => 'Russia'
            ],
            [
                'id' => 4,
                'name' => 'i-Space',
                'country' => 'China'
            ]
        ]);
    }
}
