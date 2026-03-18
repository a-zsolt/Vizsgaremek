<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CarModels extends Model
{
    protected $table = 'car_models';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'year',
        'description',
        'base_price',
        'model_file',
    ];

    public function carSpecs(): HasOne
    {
        return $this->hasOne(CarSpecs::class, 'car_model_id');
    }

    public function colorOptions(): HasMany
    {
        return $this->hasMany(Color_Options::class, 'car_model_id');
    }

    public function wheelOptions(): HasMany
    {
        return $this->hasMany(Wheel_Options::class, 'car_model_id');
    }

    public function interiorOptions(): HasMany
    {
        return $this->hasMany(Interior_Options::class, 'car_model_id');
    }

    public function accessories(): HasMany
    {
        return $this->hasMany(Accessories::class, 'car_model_id');
    }

    public function configs(): HasMany
    {
        return $this->hasMany(Configs::class, 'car_model_id');
    }
}
