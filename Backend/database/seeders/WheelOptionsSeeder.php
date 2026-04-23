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
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/bbsLM.webp',
            ],
            [
                'car_model_id' => $gt3->id,
                'name' => 'HRE S2H',
                'color' => 'Frozen Gold center, Polished Dark Clear outer and inner.',
                'material' => 'Aluminum',
                'size' => 19,
                'price' => 15000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreS2H.png',
            ],
            [
                'car_model_id' => $gt3->id,
                'name' => 'HRE HX100',
                'color' => 'Gloss Black center, Carbon Fiber outer and inner.',
                'material' => 'Aluminum, Carbon Fiber',
                'size' => 19,
                'price' => 30000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreHX100.png',
            ],

            [
                'car_model_id' => $cgt->id,
                'name' => 'BBS LM',
                'color' => 'Triple Chrome',
                'material' => 'Aluminum',
                'size' => 18,
                'price' => 25000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/bbsLM.webp',
            ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'HRE S2H',
                'color' => 'Frozen Gold center, Polished Dark Clear outer and inner.',
                'material' => 'Aluminum',
                'size' => 18,
                'price' => 15000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreS2H.png',
            ],
            [
                'car_model_id' => $cgt->id,
                'name' => 'HRE HX100',
                'color' => 'Gloss Black center, Carbon Fiber outer and inner.',
                'material' => 'Aluminum, Carbon Fiber',
                'size' => 18,
                'price' => 30000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreHX100.png',
            ],

            [
                'car_model_id' => $turbo930->id,
                'name' => 'BBS LM',
                'color' => 'Triple Chrome',
                'material' => 'Aluminum',
                'size' => 12,
                'price' => 25000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/bbsLM.webp',
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'HRE S2H',
                'color' => 'Frozen Gold center, Polished Dark Clear outer and inner.',
                'material' => 'Aluminum',
                'size' => 12,
                'price' => 15000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreS2H.png',
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'HRE HX100',
                'color' => 'Gloss Black center, Carbon Fiber outer and inner.',
                'material' => 'Aluminum, Carbon Fiber',
                'size' => 12,
                'price' => 30000,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/hreHX100.png',
            ],
            [
                'car_model_id' => $turbo930->id,
                'name' => 'Fuchs',
                'color' => 'Two tone',
                'material' => 'Alloy',
                'size' => 9,
                'price' => 8500,
                'img_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/Images/options/fuchs.jpg',
            ],
        ];

        foreach ($wheelOptions as $wheelOption) {
            Wheel_Options::create($wheelOption);
        }
    }
}
