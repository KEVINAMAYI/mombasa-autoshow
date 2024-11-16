<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [ 'name' => 'Sedan' ],
            [ 'name' => 'Coupe' ],
            [ 'name' => 'Hatchback' ],
            [ 'name' => 'Station Wagon' ],
            [ 'name' => 'SUV' ],
            [ 'name' => 'Pick up' ],
            [ 'name' => 'Van' ],
            [ 'name' => 'Mini van' ],
            [ 'name' => 'Wagon' ],
            [ 'name' => 'Convertible' ],
            [ 'name' => 'Bus' ],
            [ 'name' => 'Track' ],
        ]);
    }
}
