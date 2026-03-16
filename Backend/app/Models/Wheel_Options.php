<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wheel_Options extends Model
{
    protected $table = 'wheel__options';

    public $timestamps = false;

    protected $fillable = [
        'car_model_id',
        'name',
        'color',
        'material',
        'size',
        'price',
    ];

    public function carModel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }
}
