<?php

namespace Database\Seeders;

use App\Models\Accessories;
use App\Models\CarModels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gt3 = CarModels::where('name', 'GT3 997.2')->first();
        $cgt = CarModels::where('name', 'Carrera GT')->first();
        $turbo930 = CarModels::where('name', '930 Turbo')->first();

        $accessories = [
            // GT3 997.2
            [
                'car_model_id' => $gt3->id,
                'name'         => 'Sport Chrono Package',
                'price'        => 1490,
            ],
            [
                'car_model_id' => $gt3->id,
                'name'         => 'Carbon Ceramic Brakes (PCCB)',
                'price'        => 8150,
            ],
            [
                'car_model_id' => $gt3->id,
                'name'         => 'Rear Wiper Delete',
                'price'        => 100,
            ],
            [
                'car_model_id' => $gt3->id,
                'name'         => 'Fire Extinguisher (Onboard)',
                'price'        => 380,
            ],
            [
                'car_model_id' => $gt3->id,
                'name'         => 'Porsche Crest on Headrests',
                'price'        => 850,
            ],

            // Carrera GT
            [
                'car_model_id' => $cgt->id,
                'name'         => 'Custom Luggage Set',
                'price'        => 3200,
            ],
            [
                'car_model_id' => $cgt->id,
                'name'         => 'Carbon Fiber Engine Cover',
                'price'        => 11000,
            ],
            [
                'car_model_id' => $cgt->id,
                'name'         => 'Bose Sound System',
                'price'        => 1950,
            ],
            [
                'car_model_id' => $cgt->id,
                'name'         => 'Porsche Crest on Headrests',
                'price'        => 850,
            ],
            [
                'car_model_id' => $cgt->id,
                'name'         => 'Carbon Ceramic Brakes (PCCB)',
                'price'        => 12500,
            ],

            // 930 Turbo
            [
                'car_model_id' => $turbo930->id,
                'name'         => 'Whale Tail Rear Spoiler',
                'price'        => 5500,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name'         => 'Sunroof',
                'price'        => 4500,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name'         => 'Air Conditioning',
                'price'        => 2000,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name'         => 'Fuchs Alloy Wheels',
                'price'        => 5000,
            ],
            [
                'car_model_id' => $turbo930->id,
                'name'         => 'Limited Slip Differential',
                'price'        => 3500,
            ],
        ];

        foreach ($accessories as $accessory) {
            Accessories::create($accessory);
        }
    }
}
