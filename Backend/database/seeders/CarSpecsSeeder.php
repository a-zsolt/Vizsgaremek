<?php

namespace Database\Seeders;

use App\Models\CarModels;
use App\Models\CarSpecs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSpecsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specs = [
            'GT3 997.2' => [
                'acceleration'  => 4.0,
                'power'         => 435,
                'top_speed'     => 312,
                'weight'        => 1395,
                'displacement'  => 3800,
                'cylinders'     => 6,
                'transmission'  => '6-speed manual',
            ],
            'Carrera GT' => [
                'acceleration'  => 3.9,
                'power'         => 612,
                'top_speed'     => 330,
                'weight'        => 1380,
                'displacement'  => 5733,
                'cylinders'     => 10,
                'transmission'  => '6-speed manual',
            ],
            '930 Turbo' => [
                'acceleration'  => 5.2,
                'power'         => 300,
                'top_speed'     => 260,
                'weight'        => 1335,
                'displacement'  => 3299,
                'cylinders'     => 6,
                'transmission'  => '5-speed manual',
            ],
        ];

        foreach ($specs as $modelName => $spec) {
            $model = CarModels::where('name', $modelName)->first();
            if ($model) {
                $spec['car_model_id'] = $model->id;
                CarSpecs::create($spec);
            }
        }
    }
}
