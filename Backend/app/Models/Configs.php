<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Configs extends Model
{
    protected $table = 'configs';

    protected $fillable = [
        'user_id',
        'car_model_id',
        'color_option_id',
        'wheel_option_id',
        'interior_option_id',
        'accessory_id',
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
    public function interiorOption(): BelongsTo
    {
        return $this->belongsTo(Interior_Options::class, 'interior_option_id');
    }

    /**
     * Optional accessory included.
     */
    public function accessory(): BelongsTo
    {
        return $this->belongsTo(Accessories::class, 'accessory_id');
    }
}
