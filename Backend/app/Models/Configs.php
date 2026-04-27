<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Configs extends Model
{
    protected $table = 'configs';

    protected $fillable = [
        'user_id',
        'car_model_id',
        'color_option_id',
        'wheel_option_id',
        'total_price',
    ];

    /**
     * Owner of this configuration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Selected car model for this config.
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }

    /**
     * Chosen exterior color.
     */
    public function colorOption(): BelongsTo
    {
        return $this->belongsTo(Color_Options::class, 'color_option_id');
    }

    /**
     * Chosen wheel option.
     */
    public function wheelOption(): BelongsTo
    {
        return $this->belongsTo(Wheel_Options::class, 'wheel_option_id');
    }

    /**
     * Chosen interior option.
     */
    public function interiorOptions(): BelongsToMany
    {
        return $this->belongsToMany(Interior_Options::class, 'config_interior_option', 'config_id', 'interior_option_id');
    }

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(Accessories::class, 'config_accessory', 'config_id', 'accessory_id');
    }

    /**
     * Optional accessory included.
     */
    public function calculateTotalPrice(): int
    {
        $total = $this->carModel->base_price ?? 0;
        $total += $this->colorOption->price ?? 0;
        $total += $this->wheelOption->price ?? 0;

        $total += $this->interiorOptions()->sum('price');
        $total += $this->accessories()->sum('price');

        return (int) $total;
    }
}
