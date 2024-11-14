<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Town::insert([
            [
                'name' => 'Nairobi',
                'country_id' => 1
            ],
            [
                'name' => 'Kampala',
                'country_id' => 2
            ]
        ]);
    }
}
