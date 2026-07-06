<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Bogotá', 
            'latitude' => 4.6097, 
            'longitude' => -74.0817,
            'image_path' => 'cities/default_bogota.jpg'
        ]);

        City::create([
            'name' => 'Medellín', 
            'latitude' => 6.2442, 
            'longitude' => -75.5736,
            'image_path' => 'cities/default_medellin.jpg'
        ]);

        City::create([
            'name' => 'Cali', 
            'latitude' => 6.2442, 
            'longitude' => -75.5736,
            'image_path' => 'cities/default_cali.jpg'
        ]);
    }
}
