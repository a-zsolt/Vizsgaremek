<?php

namespace Database\Seeders;

use App\Models\CarModels;
use App\Models\Interior_Options;
use Illuminate\Database\Seeder;

class InteriorOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gt3 = CarModels::where('name', 'GT3 997.2')->first();
        $cgt = CarModels::where('name', 'Carrera GT')->first();
        $turbo930 = CarModels::where('name', '930 Turbo')->first();

        $interiorOptions = [
            // GT3 997.2
            [
                'car_model_id' => $gt3->id,
                'part_name'    => 'Seat Upholstery',
                'material'     => 'Full Leather',
                'color'        => 'Black',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $gt3->id,
                'part_name'    => 'Seat Upholstery',
                'material'     => 'Alcantara',
                'color'        => 'Guards Red',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $gt3->id,
                'part_name'    => 'Steering Wheel',
                'material'     => 'Alcantara',
                'color'        => 'Black',
                'price'        => 950,
            ],
            [
                'car_model_id' => $gt3->id,
                'part_name'    => 'Dashboard Trim',
                'material'     => 'Carbon Fiber',
                'color'        => 'Gloss Black',
                'price'        => 1200,
            ],

            // Carrera GT
            [
                'car_model_id' => $cgt->id,
                'part_name'    => 'Seat Upholstery',
                'material'     => 'Full Leather',
                'color'        => 'Metropol Blue',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $cgt->id,
                'part_name'    => 'Seat Upholstery',
                'material'     => 'Full Leather',
                'color'        => 'Beige',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $cgt->id,
                'part_name'    => 'Steering Wheel',
                'material'     => 'Leather',
                'color'        => 'Black',
                'price'        => 1400,
            ],
            [
                'car_model_id' => $cgt->id,
                'part_name'    => 'Door Panel Trim',
                'material'     => 'Carbon Fiber',
                'color'        => 'Gloss Black',
                'price'        => 2800,
            ],

            // 930 Turbo
            [
                'car_model_id' => $turbo930->id,
                'part_name'    => 'Seat Upholstery',
                'material'     => 'Tartan Fabric',
                'color'        => 'Pepita Check',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $turbo930->id,
                'part_name'    => 'Seat Upholstery',
                'material'     => 'Full Leather',
                'color'        => 'Cognac',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $turbo930->id,
                'part_name'    => 'Steering Wheel',
                'material'     => 'Leather',
                'color'        => 'Black',
                'price'        => 1200,
            ],
            [
                'car_model_id' => $turbo930->id,
                'part_name'    => 'Dashboard Trim',
                'material'     => 'Brushed Aluminum',
                'color'        => 'Silver',
                'price'        => 2500,
            ],
        ];

        foreach ($interiorOptions as $option) {
            Interior_Options::create($option);
        }
    }
}
