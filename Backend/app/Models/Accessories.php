<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accessories extends Model
{
    protected $table = 'accessories';

    public $timestamps = false;

    protected $fillable = [
        'car_model_id',
        'name',
        'price',
    ];

    /**
     * Parent car model for this accessory.
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }
}
