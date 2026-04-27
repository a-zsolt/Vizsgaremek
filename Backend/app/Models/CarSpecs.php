<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSpecs extends Model
{
    protected $table = 'car_specs';

    public $timestamps = false;

    protected $fillable = [
        'car_model_id',
        'acceleration',
        'power',
        'top_speed',
        'weight',
        'displacement',
        'cylinders',
        'transmission',
    ];

    /**
     * Parent car model this spec belongs to.
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }
}
