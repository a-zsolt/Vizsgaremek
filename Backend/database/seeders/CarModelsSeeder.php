<?php

namespace Database\Seeders;

use App\Models\CarModels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carModels = [
            [
                'name' => 'GT3 997.2',
                'year' => '2009-2011',
                'description' => 'The 2010–2012 Porsche 911 GT3 (997.2) is a revered, analog driver’s car featuring a 3.8L naturally aspirated "Mezger" flat-six engine (435 hp) and a 6-speed manual transmission. It is known for its high-revving nature (8,400 rpm), hydraulic steering, and raw, engaging performance. As a final, relatively compact narrow-body GT3, it represents a "sweet spot" for collectors.',
                'base_price' => 200000,
                'model_file' => '3dModels/GT3_997-2.glb',
                'image_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/CarPictures/GT3%20997.2.png'
            ],
            [
                'name' => 'Carrera GT',
                'year' => '2003-2006',
                'description' => '',
                'base_price' => 2000000,
                'model_file' => '3dModels/Carrera_GT.glb',
                'image_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/CarPictures/Carrera%20GT.png'
            ],
            [
                'name' => '930 Turbo',
                'year' => '1978-1989',
                'description' => '',
                'base_price' => 150000,
                'model_file' => '3dModels/930_Turbo.glb',
                'image_url' => 'https://pub-699e9b0acc6841d68f0848ac3fce8c7a.r2.dev/CarPictures/930%20Turbo.png'
            ]
        ];

        foreach ($carModels as $carModel) {
            CarModels::create($carModel);
        }
    }
}
