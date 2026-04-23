<?php

namespace Database\Seeders;

use App\Models\CarModels;
use App\Models\Color_Options;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gt3 = CarModels::where('name', 'GT3 997.2')->first();
        $cgt = CarModels::where('name', 'Carrera GT')->first();
        $turbo930 = CarModels::where('name', '930 Turbo')->first();

        $colorOptions = [
            // GT3 997.2
            [
                'car_model_id' => $gt3->id,
                'name' => 'Pearl White',
                'hex_code' => '#F5F5DC',
                'price' => 4997,
            ],
            [
                'car_model_id' => $gt3->id,
                'name' => 'GT Silver Metallic',
                'hex_code' => '#9E9E9E',
                'price' => 5490,
            ],
            [
                'car_model_id' => $gt3->id,
                'name' => 'Guards Red',
                'hex_code' => '#AE1C28',
                'price' => 0,
            ],
            [
                'car_model_id' => $gt3->id,
                'name' => 'Basalt Black Metallic',
                'hex_code' => '#2B2B2B',
                'price' => 5490,
            ],

            // Carrera GT
            [
                'car_model_id' => $cgt->id,
                'name' => 'Pearl White',
                'hex_code' => '#F5F5DC',
                'price' => 4997,
            ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'Fayence Yellow',
                'hex_code' => '#C8A84B',
                'price' => 6200,
            ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'Slate Grey Metallic',
                'hex_code' => '#6B6B6B',
                'price' => 5490,
            ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'Carmine Red',
                'hex_code' => '#8B1A1A',
                'price' => 5990,
            ],

            // 930 Turbo
            [
                'car_model_id' => $turbo930->id,
                'name' => 'Pearl White',
                'hex_code' => '#F5F5DC',
                'price' => 4997,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'Copper Brown Metallic',
                'hex_code' => '#7B4F2E',
                'price' => 5200,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'Minerva Blue Metallic',
                'hex_code' => '#3B5F8A',
                'price' => 5200,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'Olive Green Metallic',
                'hex_code' => '#4A5240',
                'price' => 4800,
            ],
        ];

        foreach ($colorOptions as $colorOption) {
            Color_Options::create($colorOption);
        }
    }
}
