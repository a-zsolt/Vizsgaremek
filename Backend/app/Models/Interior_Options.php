<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interior_Options extends Model
{
    protected $table = 'interior__options';

    public $timestamps = false;

    protected $fillable = [
        'car_model_id',
        'part_name',
        'material',
        'color',
        'price',
    ];

    public function carModel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }
}
