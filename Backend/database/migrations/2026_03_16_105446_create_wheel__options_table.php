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
        Schema::create('wheel__options', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignIdFor(CarModels::class, 'car_model_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('color');
            $table->string('material');
            $table->integer('size');
            $table->integer('price');
            $table->string('img_url')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wheel__options');
    }
};
