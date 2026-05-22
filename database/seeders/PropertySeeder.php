<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::create([
            'title' => 'Address Villa, Mianan',
            'address' => 'Mianan Beachfront',
            'price' => 850000,
            'beds' => 3,
            'baths' => 2,
            'sqft' => 2500,
            'type' => 'House',
            'image_path' => 'properties/house1.jpg',
        ]);

        Property::create([
            'title' => 'Address Brick Home',
            'address' => 'Downtown Suburban',
            'price' => 750000,
            'beds' => 3,
            'baths' => 2,
            'sqft' => 2200,
            'type' => 'House',
            'image_path' => 'properties/house2.jpg',
        ]);

        // Add more here to match your Figma!
    }
}
