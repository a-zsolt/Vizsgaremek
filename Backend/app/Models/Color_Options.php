<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Color_Options extends Model
{
    protected $table = 'color__options';

    public $timestamps = false;

    protected $fillable = [
        'car_model_id',
        'name',
        'hex_code',
        'price',
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }
}
