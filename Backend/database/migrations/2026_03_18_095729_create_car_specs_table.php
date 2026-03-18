<?php

use App\Models\CarModels;
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
        Schema::create('car_specs', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignIdFor(CarModels::class, 'car_model_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->double('acceleration');
            $table->integer('power');
            $table->integer('top_speed');
            $table->integer('weight');
            $table->integer('displacement');
            $table->integer('cylinders');
            $table->string('transmission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_specs');
    }
};
