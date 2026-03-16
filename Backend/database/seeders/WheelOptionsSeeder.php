<?php

namespace Database\Seeders;

use App\Models\CarModels;
use App\Models\Wheel_Options;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WheelOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gt3 = CarModels::where('name', 'GT3 997.2')->first();
        $cgt = CarModels::where('name', 'Carrera GT')->first();
        $turbo930 = CarModels::where('name', '930 Turbo')->first();

        $wheelOptions = [
            [
                'car_model_id' => $gt3->id,
                'name' => 'BBS LM',
                'color' => 'Triple Chrome',
                'material' => 'Aluminum',
                'size' => 19,
                'price' => 25000,
            ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'BBS LM',
                'color' => 'Triple Chrome',
                'material' => 'Aluminum',
                'size' => 19,
                'price' => 25000,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'BBS LM',
                'color' => 'Triple Chrome',
                'material' => 'Aluminum',
                'size' => 17,
                'price' => 25000,
            ],
        ];

        foreach ($wheelOptions as $wheelOption) {
            Wheel_Options::create($wheelOption);
        }
    }
}
