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
        'image_url',
    ];

    /**
     * One-to-one technical specifications for this model.
     */
    public function carSpecs(): HasOne
    {
        return $this->hasOne(CarSpecs::class, 'car_model_id');
    }

    /**
     * Available exterior color options for this model.
     */
    public function colorOptions(): HasMany
    {
        return $this->hasMany(Color_Options::class, 'car_model_id');
    }

    /**
     * Available wheel options for this model.
     */
    public function wheelOptions(): HasMany
    {
        return $this->hasMany(Wheel_Options::class, 'car_model_id');
    }

    /**
     * Available interior options for this model.
     */
    public function interiorOptions(): HasMany
    {
        return $this->hasMany(Interior_Options::class, 'car_model_id');
    }

    /**
     * Optional accessories available for this model.
     */
    public function accessories(): HasMany
    {
        return $this->hasMany(Accessories::class, 'car_model_id');
    }

    /**
     * User configs created for this model.
     */
    public function configs(): HasMany
    {
        return $this->hasMany(Configs::class, 'car_model_id');
    }
}
