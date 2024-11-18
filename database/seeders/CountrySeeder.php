<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::insert([
            ['name' => 'Burundi', 'code' => '257'],
            ['name' => 'Comoros', 'code' => '269'],
            ['name' => 'Democratic Republic of Congo (DRC)', 'code' => '243'],
            ['name' => 'Djibouti', 'code' => '253'],
            ['name' => 'Kenya', 'code' => '254'],
            ['name' => 'Rwanda', 'code' => '250'],
            ['name' => 'South Sudan', 'code' => '211'],
            ['name' => 'Tanzania', 'code' => '255'],
            ['name' => 'Uganda', 'code' => '256'],
        ]);
    }
}
