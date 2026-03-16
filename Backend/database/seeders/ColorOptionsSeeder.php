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
          [
              'car_model_id' => $gt3->id,
              'name' => 'Pearl White',
              'hex_code' => '#F5F5DC',
              'price' => 4997,
          ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'Pearl White',
                'hex_code' => '#F5F5DC',
                'price' => 4997,
            ],[
                'car_model_id' => $turbo930->id,
                'name' => 'Pearl White',
                'hex_code' => '#F5F5DC',
                'price' => 4997,
            ],
        ];

        foreach ($colorOptions as $colorOption) {
            Color_Options::create($colorOption);
        }
    }
}
