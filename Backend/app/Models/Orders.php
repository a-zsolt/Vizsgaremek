<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'config_id',
        'status',
    ];

    protected $guarded = ['total_price'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function config(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Configs::class, 'config_id');
    }
}
