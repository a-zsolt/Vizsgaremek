<?php

use App\Models\Accessories;
use App\Models\CarModels;
use App\Models\Color_Options;
use App\Models\Interior_Options;
use App\Models\User;
use App\Models\Wheel_Options;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CarModels::class, 'car_model_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Color_Options::class, 'color_option_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Wheel_Options::class, 'wheel_option_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Interior_Options::class, 'interior_option_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Accessories::class, 'accessory_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
